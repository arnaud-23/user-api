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
        $owner = $this->getOwner($useCaseRequest->getOwnerUuid());
        $application = $this->buildApplication($owner, $useCaseRequest);

        $this->save($application);

        return $this->buildResponse($application);
    }

    private function getOwner(string $ownerUuid): User
    {
        return $this->userGateway->findByUuid($ownerUuid);
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
        return UseCaseResponseAssembler::create(ApplicationResponse::class, $application);
    }
}
