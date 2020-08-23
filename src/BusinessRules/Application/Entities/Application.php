<?php

declare(strict_types=1);

namespace App\BusinessRules\Application\Entities;

use App\BusinessRules\User\Entities\User;
use Ramsey\Uuid\Uuid;

abstract class Application
{
    /** @var ApplicationUser[] */
    protected array $applicationUsers = [];

    protected int $id;

    protected string $name;

    protected User $owner;

    protected string $uuid;

    public function __construct(User $owner, string $name)
    {
        $this->owner = $owner;
        $this->name = $name;
        $this->uuid = Uuid::uuid4()->toString();
    }

    /** @return User[] */
    final public function getUsers(): array
    {
        return array_map(
            fn(ApplicationUser $applicationUser) => $applicationUser->getUser(),
            $this->applicationUsers
        );
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
