<?php

declare(strict_types=1);

namespace App\BusinessRules\User\UseCases;

use App\BusinessRules\UseCase;
use App\BusinessRules\UseCaseRequest;
use App\BusinessRules\UseCaseResponseAssembler;
use App\BusinessRules\User\Entities\User;
use App\BusinessRules\User\Gateways\UserGateway;
use App\BusinessRules\User\Requestors\GetUserRequest;
use App\BusinessRules\User\Responders\UserResponse;

final class GetUser implements UseCase
{
    private UserGateway $userGateway;

    public function __construct(UserGateway $userGateway)
    {
        $this->userGateway = $userGateway;
    }

    /** @param GetUserRequest $useCaseRequest */
    public function execute(UseCaseRequest $useCaseRequest): UserResponse
    {
        $user = $this->getUser($useCaseRequest);

        return $this->buildResponse($user);
    }

    private function getUser(GetUserRequest $useCaseRequest): User
    {
        return $this->userGateway->findById($useCaseRequest->getUserId());
    }

    private function buildResponse(User $user): UserResponse
    {
        return UseCaseResponseAssembler::create(UserResponse::class, $user);
    }
}
