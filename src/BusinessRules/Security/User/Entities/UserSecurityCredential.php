<?php

namespace App\BusinessRules\Security\User\Entities;

use App\BusinessRules\User\Entities\User;
use Carbon\CarbonImmutable;

abstract class UserSecurityCredential
{
    /** @var \DateTimeInterface */
    protected $createdAt;

    /** @var string */
    protected $password;

    /** @var string[] */
    protected $roles;

    /** @var string */
    protected $salt;

    /** @var User */
    protected $user;

    public function __construct()
    {
        $this->createdAt = CarbonImmutable::now();
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password, string $salt): void
    {
        $this->password = $password;
        $this->salt = $salt;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function addRole(string $role): void
    {
        if (!array_search($role, $this->roles)) {
            $this->roles[] = $role;
        }
    }

    public function removeRole(string $role): void
    {
        if (false !== $key = array_search($role, $this->roles)) {
            unset($this->roles[$key]);
        }
    }

    public function getSalt(): string
    {
        return $this->salt;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}