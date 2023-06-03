<?php

namespace Tedon\LaravelFinnotech\Results;

use Illuminate\Support\Arr;

class ShahkarVerifyResult extends BaseResult
{
    private ?bool $isValid;

    public function __construct(
        ?array $raw = null
    ) {
        parent::__construct($raw);

        $this->isValid = Arr::get($this->raw, 'isValid');
    }

    /**
     * @return bool|null
     */
    public function getIsValid(): ?bool
    {
        return $this->isValid;
    }

    public function jsonSerialize(): array
    {
        return Arr::except(get_object_vars($this), 'raw');
    }
}
