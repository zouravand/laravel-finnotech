<?php

namespace Tedon\LaravelFinnotech\Results;

use Illuminate\Support\Arr;
use JsonSerializable;

class BaseResult implements JsonSerializable
{
    public function __construct(
        protected ?array $raw = null
    ) {
    }

    public function jsonSerialize(): array
    {
        return Arr::except(get_object_vars($this), 'raw');
    }
}
