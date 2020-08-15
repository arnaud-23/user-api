<?php

declare(strict_types=1);

namespace App\BusinessRules\Application\UseCases;

use App\BusinessRules\Application\Entities\Application;
use App\BusinessRules\Application\Requestors\GetUserApplicationsRequest;
use App\BusinessRules\Application\Responders\ApplicationResponse;
use App\BusinessRules\Application\Responders\ApplicationsResponse;
use App\BusinessRules\UseCaseResponseAssembler;
use App\BusinessRules\User\Gateways\UserNotFoundException;
use App\Doubles\Assert;
use App\Doubles\BusinessRules\Application\Gateways\InMemoryApplicationGateway;
use App\Doubles\BusinessRules\User\Gateways\InMemoryUserGateway;
use App\Fixtures\InMemoryFixtureGateway;
use PHPUnit\Framework\TestCase;

final class GetUserApplicationsTest extends TestCase
{
    private GetUserApplicationsRequest $request;

    private GetUserApplications $useCase;

    /** @test */
    public function noUserExistWithThisUuidThrowNotFoundException(): void
    {
        InMemoryUserGateway::$users = [];
        $this->expectException(UserNotFoundException::class);

        $this->useCase->execute($this->request);
    }

    /** @test */
    public function noApplicationFoundReturnEmptyResponse(): void
    {
        InMemoryApplicationGateway::$applications = [];
        $response = $this->useCase->execute($this->request);

        Assert::assertObjectsEquals([], $response->getApplications());
    }

    /** @test */
    public function getApplicationReturnResponse(): void
    {
        $response = $this->useCase->execute($this->request);

        /** @var Application $expectedEntity */
        $expectedEntity = InMemoryFixtureGateway::get('Application1');
        /** @var ApplicationResponse $response */
        $expectedResponse = UseCaseResponseAssembler::create(ApplicationResponse::class, $expectedEntity);
        Assert::assertObjectsEquals(ApplicationsResponse::create([$expectedResponse]), $response);
    }

    protected function setUp(): void
    {
        $this->request = $this->buildRequest();
        $this->useCase = new GetUserApplications(
            new InMemoryApplicationGateway([InMemoryFixtureGateway::get('Application1')]),
            new InMemoryUserGateway([InMemoryFixtureGateway::get('User1')]),
        );
    }

    private function buildRequest(): GetUserApplicationsRequest
    {
        /** @var Application $applicationStub */
        $applicationStub = InMemoryFixtureGateway::get('Application1');

        return GetUserApplicationsRequest::create($applicationStub->getOwnerUuid());
    }
}
