<?php

declare(strict_types=1);

namespace App\BusinessRules\User\UseCases;

use App\BusinessRules\InvalidRequestException;
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
        $this->checkRequestIntegrity($useCaseRequest);
        $user = $this->getUser($useCaseRequest);

        return $this->buildResponse($user);
    }

    private function checkRequestIntegrity(GetUserRequest $useCaseRequest): void
    {
        if (null === $useCaseRequest->getUserUuid() &&
            null === $useCaseRequest->getUserId()
        ) {
            throw new InvalidRequestException('parameter "userUuid" or "userId" should be defined.');
        }
    }

    private function getUser(GetUserRequest $useCaseRequest): User
    {
        if ($useCaseRequest->getUserId()) {
            return $this->userGateway->findById($useCaseRequest->getUserId());
        }

        return $this->userGateway->findByUuid($useCaseRequest->getUserUuid());
    }

    private function buildResponse(User $user): UserResponse
    {
        return UseCaseResponseAssembler::create(UserResponse::class, $user);
    }
}
