<?php

namespace App\BusinessRules\User\Entities;

use Carbon\Carbon;

abstract class User
{
    /**
     * @var \DateTimeInterface
     */
    protected $createdAt;

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
    protected $LastName;

    /**
     * @var string
     */
    protected $uuid;

    public function __construct(string $email)
    {
        $this->email = $email;
        $this->createdAt = new Carbon();
    }

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

    public function getId(): string
    {
        return $this->id;
    }

    public function getLastName(): string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): void
    {
        $this->LastName = $LastName;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }
}