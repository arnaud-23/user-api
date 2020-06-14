<?php

namespace App\BusinessRules\Application\Responders;

use App\BusinessRules\UseCaseResponse;

final class ApplicationResponse implements UseCaseResponse
{
    public string $name = '';

    public string $owner = '';

    public string $uuid = '';

    public function getName(): string
    {
        return $this->name;
    }

    public function getOwner(): string
    {
        return $this->owner;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
