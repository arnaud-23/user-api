<?php

declare(strict_types=1);

namespace App\BusinessRules\Application\UseCases;

use App\BusinessRules\Application\Entities\Application;
use App\BusinessRules\Application\Gateways\ApplicationGateway;
use App\BusinessRules\Application\Requestors\GetApplicationUsersRequest;
use App\BusinessRules\UseCase;
use App\BusinessRules\UseCaseRequest;
use App\BusinessRules\UseCaseResponseAssembler;
use App\BusinessRules\User\Entities\User;
use App\BusinessRules\User\Responders\UserResponse;
use App\BusinessRules\User\Responders\UsersResponse;

final class GetApplicationUsers implements UseCase
{
    private ApplicationGateway $applicationGateway;

    public function __construct(ApplicationGateway $applicationGateway)
    {
        $this->applicationGateway = $applicationGateway;
    }

    /** @param GetApplicationUsersRequest $useCaseRequest */
    public function execute(UseCaseRequest $useCaseRequest): UsersResponse
    {
        $application = $this->getApplication($useCaseRequest->applicationUuid);
        $users = $application->getUsers();

        return $this->buildResponse($users);
    }

    private function getApplication(string $uuid): Application
    {
        return $this->applicationGateway->findByUuid($uuid);
    }

    /** @param User[] $users */
    private function buildResponse(array $users): UsersResponse
    {
        return UsersResponse::create(
            array_map(
                fn(User $user) => UseCaseResponseAssembler::create(UserResponse::class, $user),
                $users
            )
        );
    }
}
