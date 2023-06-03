<?php

namespace Tedon\LaravelFinnotech\Responses;

use Illuminate\Support\Arr;
use JsonSerializable;
use Tedon\LaravelFinnotech\Errors\BaseError;
use Tedon\LaravelFinnotech\Models\Transaction;
use Tedon\LaravelFinnotech\Results\BaseResult;

abstract class BaseResponse implements JsonSerializable
{
    private ?string $trackId;
    private ?string $status;
    protected ?BaseResult $result = null;
    private ?BaseError $error;
    protected ?string $type = null;
    protected ?array $rawResult;

    public function __construct(
        protected readonly ?array $raw = null
    ) {
        $this->trackId = Arr::get($this->raw, 'trackId');
        $this->status = Arr::get($this->raw, 'status');
        $this->rawResult = Arr::get($this->raw, 'result');
        $this->error = (Arr::get($this->raw, 'error')) ? new BaseError(Arr::get($this->raw, 'error')) : null;
    }

    /**
     * @return string|null
     */
    public function getTrackId(): ?string
    {
        return $this->trackId;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getResult(): ?BaseResult
    {
        return $this->result;
    }

    /**
     * @return ?BaseError
     */
    public function getError(): ?BaseError
    {
        return $this->error;
    }

    /**
     * @return ?string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    public function saveToDB(array $inputs = []): Transaction
    {
        /** @var Transaction $transaction */
        $transaction = Transaction::query()
            ->create([
                'type'     => $this->getType(),
                'track_id' => $this->getTrackId(),
                'status'   => $this->getStatus(),
                'error'    => $this->getError(),
                'result'   => $this->getResult(),
                'inputs'   => $inputs,
            ]);

        return $transaction;
    }

    public function jsonSerialize(): array
    {
        return Arr::except(get_object_vars($this), 'raw');
    }
}
