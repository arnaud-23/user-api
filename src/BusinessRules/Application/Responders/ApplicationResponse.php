<?php

declare(strict_types=1);

namespace App\BusinessRules\Application\Responders;

use App\BusinessRules\UseCaseResponse;

final class ApplicationResponse implements UseCaseResponse
{
    public string $name = '';

    public string $uuid = '';

    public function getName(): string
    {
        return $this->name;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
