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
        $this->email = strtolower($email);
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
        $this->firstName = ucwords(strtolower($firstName), " \t\r\n\f\v'");
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
        $this->lastName = ucwords(strtolower($lastName), " \t\r\n\f\v'");
    }

    final public function getUuid(): string
    {
        return $this->uuid;
    }
}
