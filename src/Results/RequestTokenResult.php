<?php

namespace Tedon\LaravelFinnotech\Results;

use Illuminate\Support\Arr;

class RequestTokenResult extends BaseResult
{
    private ?string $value;
    private ?string $refreshToken;
    private ?int $lifeTime;
    private ?string $creationDate;
    private ?array $scopes;

    public function __construct(
        ?array $raw = null
    ) {
        parent::__construct($raw);

        $this->value = Arr::get($this->raw, 'value');
        $this->refreshToken = Arr::get($this->raw, 'refreshToken');
        $this->lifeTime = Arr::get($this->raw, 'lifeTime');
        $this->creationDate = Arr::get($this->raw, 'creationDate');
        $this->scopes = Arr::get($this->raw, 'scopes');
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @return string|null
     */
    public function getAccessToken(): ?string
    {
        return $this->getValue();
    }

    /**
     * @return string|null
     */
    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    /**
     * @return int|null
     */
    public function getLifeTime(): ?int
    {
        return $this->lifeTime;
    }

    /**
     * @return string|null
     */
    public function getCreationDate(): ?string
    {
        return $this->creationDate;
    }

    /**
     * @return array|null
     */
    public function getScopes(): ?array
    {
        return $this->scopes;
    }

    public function jsonSerialize(): array
    {
        return Arr::except(get_object_vars($this), 'raw');
    }
}
