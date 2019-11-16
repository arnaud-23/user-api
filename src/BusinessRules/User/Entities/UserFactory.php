<?php

namespace App\BusinessRules\User\Entities;

interface UserFactory
{
    public function create(string $email): User;
}