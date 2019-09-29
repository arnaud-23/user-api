<?php

namespace App\BusinessRules\User\UseCases\DTO\Response;

use App\BusinessRules\User\Responders\UserResponse;

class UserResponseDTO implements UserResponse
{
    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $firstName;

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $lastName;

    /**
     * @var string
     */
    public $uuid;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getId(): int
    {
        return $this->id;
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