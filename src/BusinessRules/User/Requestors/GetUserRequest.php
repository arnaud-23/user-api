<?php

declare(strict_types=1);

namespace App\BusinessRules\User\Requestors;

use App\BusinessRules\UseCaseRequest;

interface GetUserRequest extends UseCaseRequest
{
    public function getUserId(): int;
}
