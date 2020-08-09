<?php

declare(strict_types=1);

namespace App\BusinessRules\User\Entities;

use Ramsey\Uuid\Uuid;

abstract class User
{
    protected string $email;

    protected string $firstName;

    protected int $id;

    protected string $lastName;

    protected string $uuid;

    public function __construct(string $email)
    {
        $this->email = $email;
        $this->uuid = Uuid::uuid4()->toString();
    }

    final public function getEmail(): string
    {
        return $this->email;
    }

    final public function getFirstName(): string
    {
        return $this->firstName;
    }

    final public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    final public function getId(): int
    {
        return $this->id;
    }

    final public function getLastName(): string
    {
        return $this->lastName;
    }

    final public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    final public function getUuid(): string
    {
        return $this->uuid;
    }
}
