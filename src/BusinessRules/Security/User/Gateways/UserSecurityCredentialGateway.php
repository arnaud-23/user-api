<?php

declare(strict_types=1);

namespace App\BusinessRules\Security\User\Gateways;

use App\BusinessRules\Security\User\Entities\UserSecurityCredential;

interface UserSecurityCredentialGateway
{
    /** @throws UserSecurityCredentialsNotFoundException */
    public function findById(int $id): UserSecurityCredential;

    /** @throws UserSecurityCredentialsNotFoundException */
    public function findByEmail(string $email): UserSecurityCredential;

    public function insert(UserSecurityCredential $userSecurityCredential): void;
}
