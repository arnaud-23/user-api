<?php

declare(strict_types=1);

namespace App\BusinessRules\User\Entities;

interface UserFactory
{
    public function create(string $email): User;
}
