<?php

namespace Tedon\LaravelFinnotech\Responses;

use Illuminate\Support\Arr;
use Tedon\LaravelFinnotech\Results\ShahkarVerifyResult;

class ShahkarVerifyResponse extends BaseResponse
{
    public function __construct(
        ?array $raw = null
    ) {
        $this->type = 'shahkar_verify';

        parent::__construct($raw);

        if ($this->rawResult) {
            $this->result = new ShahkarVerifyResult($this->rawResult);
        }
    }

    public function jsonSerialize(): array
    {
        return Arr::except(get_object_vars($this), 'raw');
    }
}
