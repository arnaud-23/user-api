<?php

namespace App\BusinessRules\Application\Requestors;

use App\BusinessRules\UseCaseRequest;

final class RegisterApplicationRequest implements UseCaseRequest
{
    public string $name;

    public int $ownerId;

    public function __construct(string $name, int $ownerId)
    {
        $this->name = $name;
        $this->ownerId = $ownerId;
    }

    public static function create(string $name, int $ownerId): RegisterApplicationRequest
    {
        return new self($name, $ownerId);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOwnerId(): int
    {
        return $this->ownerId;
    }
}
