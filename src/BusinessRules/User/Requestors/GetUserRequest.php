<?php

declare(strict_types=1);

namespace App\BusinessRules\User\Requestors;

use App\BusinessRules\UseCaseRequest;

final class GetUserRequest implements UseCaseRequest
{
    public int $userId;

    public static function create(): GetUserRequest
    {
        return new self();
    }

    public function withUserId(int $userId): GetUserRequest
    {
        $this->userId = $userId;

        return $this;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}
