<?php

declare(strict_types=1);

namespace App\Doubles\BusinessRules\Security\User\Gateways;

use App\BusinessRules\Security\User\Entities\UserSecurityCredential;
use App\BusinessRules\Security\User\Gateways\UserSecurityCredentialGateway;
use App\BusinessRules\Security\User\Gateways\UserSecurityCredentialsNotFoundException;

final class InMemoryUserSecurityGateway implements UserSecurityCredentialGateway
{
    /** @var UserSecurityCredential[] */
    public static array $userSecurityCredentials = [];

    public function __construct(array $userSecurityCredentials = [])
    {
        self::$userSecurityCredentials = $userSecurityCredentials;
    }

    public function findById(int $id): UserSecurityCredential
    {
        if (!empty(self::$userSecurityCredentials)) {
            return reset(self::$userSecurityCredentials);
        }

        throw new UserSecurityCredentialsNotFoundException();
    }

    public function findByEmail(string $email): UserSecurityCredential
    {
        if (!empty(self::$userSecurityCredentials)) {
            return reset(self::$userSecurityCredentials);
        }

        throw new UserSecurityCredentialsNotFoundException();
    }

    public function insert(UserSecurityCredential $userSecurityCredential): void
    {
        self::$userSecurityCredentials[] = $userSecurityCredential;
    }
}
