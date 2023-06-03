<?php

namespace Tedon\LaravelFinnotech\Responses;

use Illuminate\Support\Arr;
use Tedon\LaravelFinnotech\Results\RequestTokenResult;

class RequestTokenResponse extends BaseResponse
{
    public function __construct(
        ?array $raw = null
    ) {
        $this->type = 'request_token';

        parent::__construct($raw);

        if ($this->rawResult) {
            $this->result = new RequestTokenResult($this->rawResult);
        }
    }

    public function jsonSerialize(): array
    {
        return Arr::except(get_object_vars($this), 'raw');
    }
}
