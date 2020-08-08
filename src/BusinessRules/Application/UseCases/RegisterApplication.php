<?php

declare(strict_types=1);

namespace App\BusinessRules\Application\UseCases;

use App\BusinessRules\Application\Entities\Application;
use App\BusinessRules\Application\Entities\ApplicationFactory;
use App\BusinessRules\Application\Gateways\ApplicationGateway;
use App\BusinessRules\Application\Requestors\RegisterApplicationRequest;
use App\BusinessRules\Application\Responders\ApplicationResponse;
use App\BusinessRules\UseCase;
use App\BusinessRules\UseCaseRequest;
use App\BusinessRules\UseCaseResponseAssembler;
use App\BusinessRules\User\Entities\User;
use App\BusinessRules\User\Gateways\UserGateway;
use App\BusinessRules\User\Responders\UserResponse;

final class RegisterApplication implements UseCase
{
    private ApplicationFactory $applicationFactory;

    private ApplicationGateway $applicationGateway;

    private UserGateway $userGateway;

    public function __construct(
        ApplicationFactory $applicationFactory,
        ApplicationGateway $applicationGateway,
        UserGateway $userGateway
    ) {
        $this->applicationFactory = $applicationFactory;
        $this->applicationGateway = $applicationGateway;
        $this->userGateway = $userGateway;
    }

    /** @param RegisterApplicationRequest $useCaseRequest */
    public function execute(UseCaseRequest $useCaseRequest): ApplicationResponse
    {
        $owner = $this->getOwner($useCaseRequest);
        $application = $this->buildApplication($owner, $useCaseRequest);

        $this->save($application);

        return $this->buildResponse($application);
    }

    protected function getOwner(RegisterApplicationRequest $useCaseRequest): User
    {
        return $this->userGateway->findById($useCaseRequest->getOwnerId());
    }

    private function buildApplication(User $owner, RegisterApplicationRequest $useCaseRequest): Application
    {
        return $this->applicationFactory->create($owner, $useCaseRequest->getName());
    }

    private function save(Application $application): void
    {
        $this->applicationGateway->insert($application);
    }

    private function buildResponse(Application $application): ApplicationResponse
    {
        /** @var ApplicationResponse $applicationResponse */
        $applicationResponse = UseCaseResponseAssembler::create(ApplicationResponse::class, $application, ['owner']);
        $applicationResponse->owner = UseCaseResponseAssembler::create(UserResponse::class, $application->getOwner());

        return $applicationResponse;
    }
}
