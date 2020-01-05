<?php

namespace App\BusinessRules\User\Entities;

use App\BusinessRules\Security\User\Entities\UserSecurityCredential;

abstract class User
{
    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $uuid;

    /**
     * @var UserSecurityCredential
     */
    protected $securityCredential;

    public function __construct(string $email)
    {
        $this->email = $email;
        $this->makeSecurityCredential();
    }

    abstract protected function makeSecurityCredential();

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}