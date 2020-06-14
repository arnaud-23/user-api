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

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOwner(): User
    {
        return $this->owner;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
