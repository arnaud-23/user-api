<?php

declare(strict_types=1);

namespace App\BusinessRules\Security\User\Entities;

use App\BusinessRules\User\Entities\User;
use Carbon\CarbonImmutable;

abstract class UserSecurityCredential
{
    protected \DateTimeInterface $createdAt;

    protected string $password;

    /** @var string[] */
    protected array $roles = [];

    protected string $salt;

    protected User $user;

    public function __construct(User $user)
    {
        $this->createdAt = CarbonImmutable::now();
        $this->user = $user;
    }

    final public function getPassword(): string
    {
        return $this->password;
    }

    final public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    final public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    final public function addRole(string $role): void
    {
        if (!in_array($role, $this->roles)) {
            $this->roles[] = $role;
        }
    }

    final public function removeRole(string $role): void
    {
        if (false !== $key = array_search($role, $this->roles)) {
            unset($this->roles[$key]);
        }
    }

    final public function getSalt(): string
    {
        return $this->salt;
    }

    final public function setSalt(string $salt): void
    {
        $this->salt = $salt;
    }

    final public function getUser(): User
    {
        return $this->user;
    }

    final public function getUserId(): int
    {
        return $this->user->getId();
    }

    final public function getId(): int
    {
        return $this->user->getId();
    }
}
