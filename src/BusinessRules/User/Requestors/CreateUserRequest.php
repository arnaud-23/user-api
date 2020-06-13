<?php

namespace App\BusinessRules\User\Requestors;

use App\BusinessRules\UseCaseRequest;

final class CreateUserRequest implements UseCaseRequest
{
    public string $email;

    public string $firstName;

    public string $lastName;

    public string $password;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public static function create(string $email): CreateUserRequest
    {
        return new self($email);
    }

    public function withFirstName(string $firstName): CreateUserRequest
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function withLastName(string $lastName): CreateUserRequest
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function withPassword(string $password): CreateUserRequest
    {
        $this->password = $password;

        return $this;
    }

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

    public function getPassword(): string
    {
        return $this->password;
    }
}
