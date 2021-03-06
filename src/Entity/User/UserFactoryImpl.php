<?php

namespace App\Entity\User;

use App\BusinessRules\User\Entities\User;
use App\BusinessRules\User\Entities\UserFactory;

final class UserFactoryImpl implements UserFactory
{
    public function create(string $email): User
    {
        return new UserImpl($email);
    }
}