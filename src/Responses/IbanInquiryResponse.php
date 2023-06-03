<?php

namespace Tedon\LaravelFinnotech\Responses;

use Illuminate\Support\Arr;
use Tedon\LaravelFinnotech\Results\IbanInquiryResult;

class IbanInquiryResponse extends BaseResponse
{
    public function __construct(
        ?array $raw = null
    ) {
        $this->type = 'iban_inquiry';

        parent::__construct($raw);

        if ($this->rawResult) {
            $this->result = new IbanInquiryResult($this->rawResult);
        }
    }

    public function jsonSerialize(): array
    {
        return Arr::except(get_object_vars($this), 'raw');
    }
}
