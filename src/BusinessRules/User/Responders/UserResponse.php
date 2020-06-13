<?php

namespace App\BusinessRules\User\Responders;

use App\BusinessRules\UseCaseResponse;

class UserResponse implements UseCaseResponse
{
    public string $email = '';

    public string $firstName = '';

    public string $lastName = '';

    public string $uuid = '';

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
