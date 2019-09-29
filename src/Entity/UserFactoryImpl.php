<?php

namespace App\Entity;

use App\BusinessRules\User\Entities\User;
use App\BusinessRules\User\Entities\UserFactory;

class UserFactoryImpl implements UserFactory
{
    public function create(string $email): User
    {
        return new UserImpl($email);
    }
}