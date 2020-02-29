<?php

declare(strict_types=1);

namespace App\BusinessRules\User\UseCases\DTO\Request;

use App\BusinessRules\User\Requestors\GetUserRequest;
use App\BusinessRules\User\Requestors\GetUserRequestBuilder;

final class GetUserRequestBuilderImpl implements GetUserRequestBuilder
{
    private GetUserRequest $request;

    public function build(): GetUserRequest
    {
        return $this->request;
    }

    public function create(): GetUserRequestBuilder
    {
        $this->request = new GetUserRequestDTO();

        return $this;
    }

    public function withUserId(int $userId): GetUserRequestBuilder
    {
        $this->request->userId = $userId;

        return $this;
    }
}
