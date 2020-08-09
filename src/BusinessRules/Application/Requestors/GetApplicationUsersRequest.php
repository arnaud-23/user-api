<?php

declare(strict_types=1);

namespace App\BusinessRules\Application\Requestors;

use App\BusinessRules\UseCaseRequest;

final class GetApplicationUsersRequest implements UseCaseRequest
{
    public string $applicationUuid;

    public function __construct(string $applicationUuid)
    {
        $this->applicationUuid = $applicationUuid;
    }

    public static function create(string $applicationUuid): GetApplicationUsersRequest
    {
        return new self($applicationUuid);
    }

    public function getApplicationUuid(): string
    {
        return $this->applicationUuid;
    }
}
