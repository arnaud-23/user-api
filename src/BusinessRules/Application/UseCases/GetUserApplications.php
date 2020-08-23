<?php

declare(strict_types=1);

namespace App\BusinessRules\Application\UseCases;

use App\BusinessRules\Application\Entities\Application;
use App\BusinessRules\Application\Gateways\ApplicationGateway;
use App\BusinessRules\Application\Requestors\GetUserApplicationsRequest;
use App\BusinessRules\Application\Responders\ApplicationResponse;
use App\BusinessRules\Application\Responders\ApplicationsResponse;
use App\BusinessRules\UseCase;
use App\BusinessRules\UseCaseRequest;
use App\BusinessRules\UseCaseResponseAssembler;
use App\BusinessRules\User\Entities\User;
use App\BusinessRules\User\Gateways\UserGateway;

final class GetUserApplications implements UseCase
{
    private ApplicationGateway $applicationGateway;

    private UserGateway $userGateway;

    public function __construct(ApplicationGateway $applicationGateway, UserGateway $userGateway)
    {
        $this->applicationGateway = $applicationGateway;
        $this->userGateway = $userGateway;
    }

    /** @param GetUserApplicationsRequest $useCaseRequest */
    public function execute(UseCaseRequest $useCaseRequest): ApplicationsResponse
    {
        $user = $this->getUser($useCaseRequest->getUserUuid());
        $applications = $this->getApplications($user);

        return $this->buildResponse($applications);
    }

    private function getUser(string $userUuid): User
    {
        return $this->userGateway->findByUuid($userUuid);
    }

    /** @return Application[] */
    private function getApplications(User $user): array
    {
        return $this->applicationGateway->findAllByUser($user->getUuid());
    }

    /** @param Application[] $applications */
    private function buildResponse(array $applications): ApplicationsResponse
    {
        return ApplicationsResponse::create(
            array_map(
                static function (Application $application) {
                    return UseCaseResponseAssembler::create(ApplicationResponse::class, $application);
                },
                $applications
            )
        );
    }
}
