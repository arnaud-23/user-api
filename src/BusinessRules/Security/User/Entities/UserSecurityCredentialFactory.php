<?php

declare(strict_types=1);

namespace App\BusinessRules\Security\User\Entities;

use App\BusinessRules\User\Entities\User;

interface UserSecurityCredentialFactory
{
    public function create(User $user, string $password): UserSecurityCredential;
}
