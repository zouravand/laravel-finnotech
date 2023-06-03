<?php

namespace Tedon\LaravelFinnotech\Facades;

use Illuminate\Support\Facades\Facade;
use Tedon\LaravelFinnotech\Responses\IbanInquiryResponse;
use Tedon\LaravelFinnotech\Responses\RequestTokenResponse;
use Tedon\LaravelFinnotech\Responses\ShahkarVerifyResponse;

/**
 * @method static ShahkarVerifyResponse shahkarVerify(string $mobile, string $national_id)
 * @method static IbanInquiryResponse ibanInquiry(string $iban)
 * @method static RequestTokenResponse requestToken()
 * @method static getToken()
 */
class Finnotech extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'finnotech';
    }
}
