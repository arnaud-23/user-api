<?php

declare(strict_types=1);

namespace App\BusinessRules\User\UseCases;

use App\BusinessRules\UseCase;
use App\BusinessRules\UseCaseRequest;
use App\BusinessRules\UseCaseResponse;
use App\BusinessRules\User\Requestors\GetUserRequest;

final class GetUser implements UseCase
{
    /**
     * @inheritDoc
     */
    public function execute(UseCaseRequest $useCaseRequest): UseCaseResponse
    {
        // TODO: Implement execute() method.
    }
}
