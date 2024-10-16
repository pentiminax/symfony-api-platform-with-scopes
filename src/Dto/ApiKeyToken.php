<?php

namespace App\Dto;

readonly class ApiKeyToken
{
    public function __construct(
        private string $plainToken,
        private string $hashedToken
    ) {
    }

    public function getPlainToken(): string
    {
        return $this->plainToken;
    }

    public function getHashedToken(): string
    {
        return $this->hashedToken;
    }
}