<?php

namespace App\BusinessRules\User\UseCases;

use App\BusinessRules\Security\User\Entities\UserSecurityCredential;
use App\BusinessRules\Security\User\Entities\UserSecurityCredentialFactory;
use App\BusinessRules\Security\User\Gateways\UserSecurityCredentialGateway;
use App\BusinessRules\UseCase;
use App\BusinessRules\UseCaseRequest;
use App\BusinessRules\User\Entities\User;
use App\BusinessRules\User\Entities\UserFactory;
use App\BusinessRules\User\Gateways\UserGateway;
use App\BusinessRules\User\Requestors\CreateUserRequest;
use App\BusinessRules\User\Responders\UserResponse;
use App\BusinessRules\User\Responders\UserResponseAssembler;

class CreateUser implements UseCase
{
    /**
     * @var UserFactory
     */
    private $userFactory;

    /**
     * @var UserGateway
     */
    private $userGateway;

    /**
     * @var UserSecurityCredentialFactory
     */
    private $userSecurityCredentialFactory;

    /**
     * @var UserSecurityCredentialGateway
     */
    private $userSecurityCredentialGateway;

    /**
     * @var UserResponseAssembler
     */
    private $userResponseAssembler;

    public function __construct(
        UserFactory $userFactory,
        UserGateway $userGateway,
        UserSecurityCredentialFactory $userSecurityCredentialFactory,
        UserSecurityCredentialGateway $userSecurityCredentialGateway,
        UserResponseAssembler $userResponseAssembler
    ) {
        $this->userFactory = $userFactory;
        $this->userGateway = $userGateway;
        $this->userSecurityCredentialFactory = $userSecurityCredentialFactory;
        $this->userSecurityCredentialGateway = $userSecurityCredentialGateway;
        $this->userResponseAssembler = $userResponseAssembler;
    }

    /**
     * @param CreateUserRequest $useCaseRequest
     */
    public function execute(UseCaseRequest $useCaseRequest): UserResponse
    {
        $user = $this->buildUser($useCaseRequest);
        $credentials = $this->buildSecurityCredentials($useCaseRequest, $user);

        $this->save($user, $credentials);

        return $this->userResponseAssembler->create($user);
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
}
