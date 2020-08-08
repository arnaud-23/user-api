<?php

declare(strict_types=1);

namespace App\BusinessRules\Application\Responders;

use App\BusinessRules\UseCaseResponse;
use App\BusinessRules\User\Responders\UserResponse;

final class ApplicationResponse implements UseCaseResponse
{
    public string $name = '';

    public UserResponse $owner;

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
