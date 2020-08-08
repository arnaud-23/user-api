<?php

declare(strict_types=1);

namespace App\BusinessRules\Application\Entities;

use App\BusinessRules\User\Entities\User;

abstract class Application
{
    protected int $id;

    protected string $name;

    protected User $owner;

    protected string $uuid;

    public function __construct(User $owner, string $name)
    {
        $this->owner = $owner;
        $this->name = $name;
    }

    final public function getId(): int
    {
        return $this->id;
    }

    final public function getName(): string
    {
        return $this->name;
    }

    final public function getOwnerUuid(): string
    {
        return $this->getOwner()->getUuid();
    }

    final public function getOwner(): User
    {
        return $this->owner;
    }

    final public function getUuid(): string
    {
        return $this->uuid;
    }
}
