<?php

namespace App\Service;

use App\Dto\ApiKeyToken;
use App\Entity\ApiKey;
use App\Enum\ApiScope;
use App\Repository\ApiKeyRepository;

readonly class ApiKeyGenerator
{
    public function __construct(
        private ApiKeyRepository $apiKeyRepository
    ) {
    }

    public function generateToken(): ApiKeyToken
    {
        $token = bin2hex(random_bytes(32));
        $hashedToken = hash('sha256', $token);

        return new ApiKeyToken(
            plainToken: $token,
            hashedToken: $hashedToken
        );
    }

    public function createApiKeyFromToken(ApiKeyToken $token): ApiKey
    {
        $apiKey = new ApiKey();
        $randomName = bin2hex(random_bytes(4));

        $apiKey
            ->setName($randomName)
            ->setToken($token->getHashedToken())
            ->setScopes(ApiScope::cases())
            ->setCreatedAt(new \DateTimeImmutable())
        ;

        $this->apiKeyRepository->save($apiKey);

        return $apiKey;
    }
}