<?php

declare(strict_types=1);

namespace App\BusinessRules\Application\UseCases;

use App\BusinessRules\Application\Entities\Application;
use App\BusinessRules\Application\Gateways\ApplicationNotFoundException;
use App\BusinessRules\Application\Requestors\GetApplicationUsersRequest;
use App\BusinessRules\UseCaseResponseAssembler;
use App\BusinessRules\User\Responders\UserResponse;
use App\Doubles\Assert;
use App\Doubles\BusinessRules\Application\Gateways\InMemoryApplicationGateway;
use App\Doubles\BusinessRules\EntityModifier;
use App\Fixtures\InMemoryFixtureGateway;
use PHPUnit\Framework\TestCase;

final class GetApplicationUsersTest extends TestCase
{
    private GetApplicationUsers $useCase;

    /** @test */
    public function applicationDoesNotExistThrowException(): void
    {
        InMemoryApplicationGateway::$applications = [];
        $this->expectException(ApplicationNotFoundException::class);

        $this->useCase->execute(GetApplicationUsersRequest::create('unknownUuid'));
    }

    /** @test */
    public function applicationWithUserReturnResponse(): void
    {
        /** @var Application $applicationStub */
        $applicationStub = InMemoryFixtureGateway::get('Application1');
        $response = $this->useCase->execute(GetApplicationUsersRequest::create($applicationStub->getUuid()));

        $expectedResponse = UseCaseResponseAssembler::create(UserResponse::class, $applicationStub->getUsers()[0]);
        Assert::assertCount(count($applicationStub->getUsers()), $response->getUsers());
        Assert::assertObjectsEquals($expectedResponse, $response->getUsers()[0]);
    }

    /** @test */
    public function applicationDoesNotHaveAnyUserReturnEmptyArray(): void
    {
        /** @var Application $applicationStub */
        $applicationStub = InMemoryFixtureGateway::get('Application1');
        EntityModifier::setProperty($applicationStub, 'applicationUsers', []);
        InMemoryApplicationGateway::$applications = [$applicationStub];

        $response = $this->useCase->execute(GetApplicationUsersRequest::create($applicationStub->getUuid()));

        Assert::assertEmpty($response->getUsers());
    }

    protected function setUp(): void
    {
        $this->useCase = new GetApplicationUsers(
            new InMemoryApplicationGateway([InMemoryFixtureGateway::get('Application1')])
        );
    }
}
