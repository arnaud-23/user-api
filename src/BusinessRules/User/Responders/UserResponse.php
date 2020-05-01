<?php

namespace App\BusinessRules\User\Responders;

use App\BusinessRules\UseCaseResponse;

interface UserResponse extends UseCaseResponse
{
    public function getEmail(): string;

    public function getFirstName(): string;

    public function getLastName(): string;

    public function getUuid(): string;
}