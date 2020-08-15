<?php

declare(strict_types=1);

namespace App\BusinessRules\User\Requestors;

use App\BusinessRules\UseCaseRequest;

final class EditUserRequest implements UseCaseRequest
{
    private ?string $firstName = null;

    private ?string $lastName = null;

    private bool $firstNameUpdated = false;

    private bool $lastNameUpdated = false;

    private string $uuid;

    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }

    public static function create(string $uuid): EditUserRequest
    {
        return new self($uuid);
    }

    public function withFirstName(string $firstName): EditUserRequest
    {
        $this->firstName = $firstName;
        $this->firstNameUpdated = true;

        return $this;
    }

    public function withLastName(string $lastName): EditUserRequest
    {
        $this->lastName = $lastName;
        $this->lastNameUpdated = true;

        return $this;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function isFirstNameUpdated(): bool
    {
        return $this->firstNameUpdated;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function isLastNameUpdated(): bool
    {
        return $this->lastNameUpdated;
    }
}
