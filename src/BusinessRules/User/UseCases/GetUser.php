<?php

declare(strict_types=1);

namespace App\BusinessRules\User\UseCases;

use App\BusinessRules\UseCase;
use App\BusinessRules\UseCaseRequest;
use App\BusinessRules\UseCaseResponse;
use App\BusinessRules\User\Entities\User;
use App\BusinessRules\User\Gateways\UserGateway;
use App\BusinessRules\User\Requestors\GetUserRequest;
use App\BusinessRules\User\Responders\UserResponse;
use App\BusinessRules\User\Responders\UserResponseAssembler;

final class GetUser implements UseCase
{
    private UserGateway $userGateway;

    private UserResponseAssembler $userResponseAssembler;

    public function __construct(UserGateway $userGateway, UserResponseAssembler $userResponseAssembler)
    {
        $this->userGateway = $userGateway;
        $this->userResponseAssembler = $userResponseAssembler;
    }

    /**
     * @param GetUserRequest $useCaseRequest
     */
    public function execute(UseCaseRequest $useCaseRequest): UseCaseResponse
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
        return $this->userResponseAssembler->create($user);
    }
}
