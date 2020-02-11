<?php

namespace App\BusinessRules\User\Requestors;

use App\BusinessRules\UseCaseRequest;

interface CreateUserRequest extends UseCaseRequest
{
    public function getEmail(): string;

    public function getFirstName(): string;

    public function getLastName(): string;

    public function getPassword(): string;
}
