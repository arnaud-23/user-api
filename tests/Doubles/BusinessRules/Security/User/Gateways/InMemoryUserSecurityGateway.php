<?php

namespace App\Tests\Doubles\BusinessRules\Security\User\Gateways;

use App\BusinessRules\Security\User\Entities\UserSecurityCredential;
use App\BusinessRules\Security\User\Gateways\UserSecurityCredentialGateway;
use App\BusinessRules\Security\User\Gateways\UserSecurityCredentialsNotFoundException;

class InMemoryUserSecurityGateway implements UserSecurityCredentialGateway
{
    /** @var UserSecurityCredential[] */
    public static $userSecurityCredentials = [];

    public function __construct(array $userSecurityCredentials = [])
    {
        self::$userSecurityCredentials = $userSecurityCredentials;
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): UserSecurityCredential
    {
        if (array_key_exists($id, self::$userSecurityCredentials)) {
            return self::$userSecurityCredentials[$id];
        }

        throw new UserSecurityCredentialsNotFoundException();
    }

    /**
     * @inheritDoc
     */
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
