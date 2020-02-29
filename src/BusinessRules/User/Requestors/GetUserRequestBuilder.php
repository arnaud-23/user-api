<?php

declare(strict_types=1);

namespace App\BusinessRules\User\Requestors;

interface GetUserRequestBuilder
{
    public function build(): GetUserRequest;

    public function create(): GetUserRequestBuilder;

    public function withUserId(int $userId): GetUserRequestBuilder;
}
