<?php

namespace Tedon\LaravelFinnotech\Results;

use Illuminate\Support\Arr;

class IbanInquiryResult extends BaseResult
{
    private ?string $IBAN;
    private ?string $bankName;
    private ?string $deposit;
    private ?string $depositDescription;
    private ?string $depositComment;
    private ?array $depositOwners;
    private ?string $depositStatus;
    private ?string $errorDescription;

    public function __construct(
        ?array $raw = null
    ) {
        parent::__construct($raw);

        $this->IBAN = Arr::get($this->raw, 'IBAN');
        $this->bankName = Arr::get($this->raw, 'bankName');
        $this->deposit = Arr::get($this->raw, 'deposit');
        $this->depositDescription = Arr::get($this->raw, 'depositDescription');
        $this->depositComment = Arr::get($this->raw, 'depositComment');
        $this->depositOwners = Arr::get($this->raw, 'depositOwners');
        $this->depositStatus = Arr::get($this->raw, 'depositStatus');
        $this->errorDescription = Arr::get($this->raw, 'errorDescription');
    }

    /**
     * @return string|null
     */
    public function getIBAN(): ?string
    {
        return $this->IBAN;
    }

    /**
     * @return string|null
     */
    public function getBankName(): ?string
    {
        return $this->bankName;
    }

    /**
     * @return string|null
     */
    public function getDeposit(): ?string
    {
        return $this->deposit;
    }

    /**
     * @return string|null
     */
    public function getDepositDescription(): ?string
    {
        return $this->depositDescription;
    }

    /**
     * @return string|null
     */
    public function getDepositComment(): ?string
    {
        return $this->depositComment;
    }

    /**
     * @return array|null
     */
    public function getDepositOwners(): ?array
    {
        return $this->depositOwners;
    }

    /**
     * @return string|null
     */
    public function getDepositStatus(): ?string
    {
        return $this->depositStatus;
    }

    /**
     * @return string|null
     */
    public function getErrorDescription(): ?string
    {
        return $this->errorDescription;
    }

    public function jsonSerialize(): array
    {
        return Arr::except(get_object_vars($this), 'raw');
    }
}
