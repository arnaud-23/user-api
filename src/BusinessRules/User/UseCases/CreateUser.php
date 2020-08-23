<?php

declare(strict_types=1);

namespace App\BusinessRules\User\UseCases;

use App\BusinessRules\Security\User\Entities\UserSecurityCredential;
use App\BusinessRules\Security\User\Entities\UserSecurityCredentialFactory;
use App\BusinessRules\Security\User\Gateways\UserSecurityCredentialGateway;
use App\BusinessRules\UseCase;
use App\BusinessRules\UseCaseRequest;
use App\BusinessRules\UseCaseResponseAssembler;
use App\BusinessRules\User\Entities\User;
use App\BusinessRules\User\Entities\UserFactory;
use App\BusinessRules\User\Gateways\UserGateway;
use App\BusinessRules\User\Requestors\CreateUserRequest;
use App\BusinessRules\User\Responders\UserResponse;

final class CreateUser implements UseCase
{
    private UserFactory $userFactory;

    private UserGateway $userGateway;

    private UserSecurityCredentialFactory $userSecurityCredentialFactory;

    private UserSecurityCredentialGateway $userSecurityCredentialGateway;

    public function __construct(
        UserFactory $userFactory,
        UserGateway $userGateway,
        UserSecurityCredentialFactory $userSecurityCredentialFactory,
        UserSecurityCredentialGateway $userSecurityCredentialGateway
    ) {
        $this->userFactory = $userFactory;
        $this->userGateway = $userGateway;
        $this->userSecurityCredentialFactory = $userSecurityCredentialFactory;
        $this->userSecurityCredentialGateway = $userSecurityCredentialGateway;
    }

    /** @param CreateUserRequest $useCaseRequest */
    public function execute(UseCaseRequest $useCaseRequest): UserResponse
    {
        $user = $this->buildUser($useCaseRequest);
        $credentials = $this->buildSecurityCredentials($useCaseRequest, $user);

        $this->save($user, $credentials);

        return $this->buildResponse($user);
    }

    private function buildUser(CreateUserRequest $useCaseRequest): User
    {
        $user = $this->userFactory->create($useCaseRequest->getEmail());
        $user->setFirstName($useCaseRequest->getFirstName());
        $user->setLastName($useCaseRequest->getLastName());

        return $user;
    }

    private function buildSecurityCredentials(UseCaseRequest $useCaseRequest, User $user): UserSecurityCredential
    {
        return $this->userSecurityCredentialFactory->create($user, $useCaseRequest->getPassword());
    }

    private function save(User $user, UserSecurityCredential $credentials): void
    {
        $this->userGateway->insert($user);
        $this->userSecurityCredentialGateway->insert($credentials);
    }

    private function buildResponse(User $user): UserResponse
    {
        return UseCaseResponseAssembler::create(UserResponse::class, $user);
    }
}
