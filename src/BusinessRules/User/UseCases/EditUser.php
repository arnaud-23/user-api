<?php

declare(strict_types=1);

namespace App\BusinessRules\User\UseCases;

use App\BusinessRules\UseCase;
use App\BusinessRules\UseCaseRequest;
use App\BusinessRules\UseCaseResponseAssembler;
use App\BusinessRules\User\Entities\User;
use App\BusinessRules\User\Gateways\UserGateway;
use App\BusinessRules\User\Requestors\EditUserRequest;
use App\BusinessRules\User\Responders\UserResponse;

final class EditUser implements UseCase
{
    private UserGateway $userGateway;

    public function __construct(UserGateway $userGateway)
    {
        $this->userGateway = $userGateway;
    }

    /** @param EditUserRequest $useCaseRequest */
    public function execute(UseCaseRequest $useCaseRequest): UserResponse
    {
        $user = $this->getUser($useCaseRequest->getUuid());
        $this->populateUser($user, $useCaseRequest);
        $this->update($user);

        return $this->buildResponse($user);
    }

    private function getUser(string $uuid): User
    {
        return $this->userGateway->findByUuid($uuid);
    }

    private function populateUser(User $user, EditUserRequest $useCaseRequest): void
    {
        !$useCaseRequest->isFirstNameUpdated() ?: $user->setFirstName($useCaseRequest->getFirstName());
        !$useCaseRequest->isLastNameUpdated() ?: $user->setLastName($useCaseRequest->getLastName());
    }

    private function update(User $user): void
    {
        $this->userGateway->update($user);
    }

    private function buildResponse(User $user): UserResponse
    {
        return UseCaseResponseAssembler::create(UserResponse::class, $user);
    }
}
