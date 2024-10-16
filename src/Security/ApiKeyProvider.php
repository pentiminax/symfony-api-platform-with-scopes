<?php

namespace App\Security;

use App\Entity\ApiKey;
use App\Repository\ApiKeyRepository;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class ApiKeyProvider implements UserProviderInterface
{
    public function __construct(
        private readonly ApiKeyRepository $apiKeyRepository
    )
    {
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        // TODO: Implement refreshUser() method.
    }

    public function supportsClass(string $class): bool
    {
        return ApiKey::class === $class;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $apiKey = $this->apiKeyRepository->findOneBy(['id' => $identifier]);

        if (null === $apiKey) {
            $e = new UserNotFoundException(sprintf('Api key "%s" not found.', $identifier));

            $e->setUserIdentifier($identifier);

            throw $e;
        }

        return new ApiKeyUser($apiKey);
    }
}