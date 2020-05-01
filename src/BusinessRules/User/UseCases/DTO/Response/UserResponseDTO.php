<?php

namespace App\BusinessRules\User\UseCases\DTO\Response;

use App\BusinessRules\User\Responders\UserResponse;

class UserResponseDTO implements UserResponse
{
    public string $email;

    public string $firstName;

    public string $lastName;

    public string $uuid;

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