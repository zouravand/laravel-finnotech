<?php

namespace Tedon\LaravelFinnotech;

use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Tedon\LaravelFinnotech\Models\Transaction;
use Tedon\LaravelFinnotech\Responses\IbanInquiryResponse;
use Tedon\LaravelFinnotech\Responses\RequestTokenResponse;
use Tedon\LaravelFinnotech\Responses\ShahkarVerifyResponse;

class Finnotech
{
    public function getToken($createOnFail = true): array|Transaction|null
    {
        /** @var Transaction $latestRequestTokenTransaction */
        $latestRequestTokenTransaction = Transaction::query()
            ->where('type', 'request_token')
            ->where('status', 'DONE')
            ->latest()
            ->first();

        if (!$latestRequestTokenTransaction) {
            if (!$createOnFail) {
                return null;
            }

            $latestRequestTokenTransaction = $this->requestToken()->saveToDB();
        }

        $result = $this->extractTokenInfo($latestRequestTokenTransaction);

        if ($result['expires_at']->subHour()->isPast()) {
            $newRequestTokenTransaction = $this->requestToken()->saveToDB();
            $result = $this->extractTokenInfo($newRequestTokenTransaction);
        }

        return $result;
    }

    private function getAccessToken(): string
    {
        $tokenResult = $this->getToken();
        return $tokenResult['token']['value'];
    }

    private function extractTokenInfo(Transaction $requestTokenTransaction): ?array
    {
        if ($requestTokenTransaction->type != 'request_token') {
            return null;
        }

        $result['token'] = $requestTokenTransaction->result;
        $lifetimeInSec = Arr::get($result['token'], 'lifeTime') / 1000;

        $result['created_at'] = Verta::parse(Arr::get($result['token'], 'creationDate'))->toCarbon();

        $result['expires_at'] = $result['created_at']->clone()->addSeconds($lifetimeInSec);

        return $result;
    }

    public function requestToken(): RequestTokenResponse
    {
        $result = Http::withBasicAuth(
            config('laravel-finnotech.credentials.username'),
            config('laravel-finnotech.credentials.password')
        )
            ->asJson()
            ->post(
                config('laravel-finnotech.base_url').config('laravel-finnotech.prefixes.dev').config('laravel-finnotech.endpoints.request_token'),
                [
                    "grant_type" => "client_credentials",
                    "nid"        => config('laravel-finnotech.credentials.nid'),
                    "scopes"     => implode(',', config('laravel-finnotech.credentials.scopes'))
                ]
            );

        return new RequestTokenResponse($result->json());
    }

    public function shahkarVerify(string $mobile, string $nationalId): ShahkarVerifyResponse
    {
        $token = $this->getAccessToken();

        $result = Http::withToken($token)
            ->asJson()
            ->get(
                config('laravel-finnotech.base_url')
                .config('laravel-finnotech.prefixes.facility')
                .config('laravel-finnotech.prefixes.clients').config('laravel-finnotech.credentials.username')
                .config('laravel-finnotech.endpoints.shahkar_verify'),
                [
                    "mobile"       => $mobile,
                    "nationalCode" => $nationalId,
                ]
            );

        return new ShahkarVerifyResponse($result->json());
    }

    public function ibanInquiry(string $iban): IbanInquiryResponse
    {
        $token = $this->getAccessToken();

        $result = Http::withToken($token)
            ->asJson()
            ->get(
                config('laravel-finnotech.base_url')
                .config('laravel-finnotech.prefixes.oak')
                .config('laravel-finnotech.prefixes.clients').config('laravel-finnotech.credentials.username')
                .config('laravel-finnotech.endpoints.iban_inquiry'),
                [
                    "iban" => $iban,
                ]
            );

        return new IbanInquiryResponse($result->json());
    }
}
