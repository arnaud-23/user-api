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
use App\BusinessRules\User\Responders\UserResponse;

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
        $user = $this->getUser($useCaseRequest);
        $applications = $this->getApplications($user->getUuid());

        return $this->buildResponse($applications);
    }

    private function getUser(GetUserApplicationsRequest $useCaseRequest): User
    {
        return $this->userGateway->findByUuid($useCaseRequest->userUuid);
    }

    /** @return Application[] */
    private function getApplications(string $userUuid): array
    {
        return $this->applicationGateway->findAllByUser($userUuid);
    }

    /** @param Application[] $applications */
    private function buildResponse(array $applications): ApplicationsResponse
    {
        return ApplicationsResponse::create(
            array_map(
                static function (Application $application) {
                    $response = UseCaseResponseAssembler::create(ApplicationResponse::class, $application, ['owner']);
                    $response->owner = UseCaseResponseAssembler::create(UserResponse::class, $application->getOwner());

                    return $response;
                },
                $applications
            )
        );
    }
}
