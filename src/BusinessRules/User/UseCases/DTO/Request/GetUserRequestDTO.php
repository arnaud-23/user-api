<?php

declare(strict_types=1);

namespace App\BusinessRules\User\UseCases\DTO\Request;

use App\BusinessRules\User\Requestors\GetUserRequest;

final class GetUserRequestDTO implements GetUserRequest
{
    public int $userId;

    public function getUserId(): int
    {
        return $this->userId;
    }
}
