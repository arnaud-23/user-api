<?php

namespace App\BusinessRules\Application\Responders;

use App\BusinessRules\UseCaseResponse;
use App\BusinessRules\User\Responders\UserResponse;

final class ApplicationResponse implements UseCaseResponse
{
    public string $name = '';

    public ?UserResponse $owner = null;

    public string $uuid = '';

    public function getName(): string
    {
        return $this->name;
    }

    public function getOwner(): UserResponse
    {
        return $this->owner;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}