<?php

declare(strict_types=1);

namespace App\BusinessRules\Application\Requestors;

use App\BusinessRules\UseCaseRequest;

final class RegisterApplicationRequest implements UseCaseRequest
{
    private string $name;

    private string $ownerUuid;

    public function __construct(string $name, string $ownerUuid)
    {
        $this->name = $name;
        $this->ownerUuid = $ownerUuid;
    }

    public static function create(string $name, string $ownerUuid): RegisterApplicationRequest
    {
        return new self($name, $ownerUuid);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOwnerUuid(): string
    {
        return $this->ownerUuid;
    }
}
