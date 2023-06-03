<?php

namespace Tedon\LaravelFinnotech\Errors;

use Illuminate\Support\Arr;
use JsonSerializable;

class BaseError implements JsonSerializable
{
    private ?string $code;
    private ?string $message;

    public function __construct(
        protected readonly ?array $raw = null
    ) {
        $this->code = Arr::get($this->raw, 'code');
        $this->message = Arr::get($this->raw, 'message');
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function jsonSerialize(): array
    {
        return Arr::except(get_object_vars($this), 'raw');
    }
}
