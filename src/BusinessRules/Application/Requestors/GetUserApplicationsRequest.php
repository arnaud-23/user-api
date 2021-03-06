<?php

declare(strict_types=1);

namespace App\BusinessRules\Application\Requestors;

use App\BusinessRules\UseCaseRequest;

final class GetUserApplicationsRequest implements UseCaseRequest
{
    private string $userUuid;

    public function __construct(string $userUuid)
    {
        $this->userUuid = $userUuid;
    }

    public static function create(string $userUuid): GetUserApplicationsRequest
    {
        return new self($userUuid);
    }

    public function getUserUuid(): string
    {
        return $this->userUuid;
    }
}
