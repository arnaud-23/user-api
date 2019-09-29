<?php

namespace App\BusinessRules\User\UseCases;

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
     * @var UserResponseAssembler
     */
    private $userResponseAssembler;

    public function __construct(
        UserFactory $userFactory,
        UserGateway $userGateway,
        UserResponseAssembler $userResponseAssembler
    ) {
        $this->userFactory = $userFactory;
        $this->userGateway = $userGateway;
        $this->userResponseAssembler = $userResponseAssembler;
    }

    /**
     * @param CreateUserRequest $useCaseRequest
     */
    public function execute(UseCaseRequest $useCaseRequest): UserResponse
    {
        $user = $this->buildUser($useCaseRequest);
        $this->save($user);

        return $this->userResponseAssembler->create($user);
    }

    private function buildUser(CreateUserRequest $useCaseRequest): User
    {
        $user = $this->userFactory->create($useCaseRequest->getEmail());
        $user->setFirstName($useCaseRequest->getFirstName());
        $user->setLastName($useCaseRequest->getLastName());

        return $user;
    }

    private function save(User $user): void
    {
        $this->userGateway->insert($user);
    }
}