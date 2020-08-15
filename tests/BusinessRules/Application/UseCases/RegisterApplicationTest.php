<?php

declare(strict_types=1);

namespace App\BusinessRules\Application\UseCases;

use App\BusinessRules\Application\Entities\Application;
use App\BusinessRules\Application\Requestors\RegisterApplicationRequest;
use App\BusinessRules\Application\Responders\ApplicationResponse;
use App\BusinessRules\UseCaseResponseAssembler;
use App\BusinessRules\User\Gateways\UserNotFoundException;
use App\BusinessRules\User\Responders\UserResponse;
use App\Doubles\Assert;
use App\Doubles\BusinessRules\Application\Gateways\InMemoryApplicationGateway;
use App\Doubles\BusinessRules\EntityModifier;
use App\Doubles\BusinessRules\User\Gateways\InMemoryUserGateway;
use App\Entity\Application\ApplicationFactoryImpl;
use App\Fixtures\InMemoryFixtureGateway;
use PHPUnit\Framework\TestCase;

final class RegisterApplicationTest extends TestCase
{
    private RegisterApplication $useCase;

    private RegisterApplicationRequest $request;

    /** @test */
    public function userDoesNotExistThrowException(): void
    {
        $this->expectException(UserNotFoundException::class);
        InMemoryUserGateway::$users = [];

        $this->useCase->execute($this->request);
    }

    /** @test */
    public function registerApplicationSaveAndReturnApplication(): void
    {
        /** @var Application $expectedEntity */
        $expectedEntity = InMemoryFixtureGateway::get('Application1');
        EntityModifier::setProperty($expectedEntity, 'applicationUsers', []);
        InMemoryApplicationGateway::$id = $expectedEntity->getId();
        InMemoryApplicationGateway::$uuid = $expectedEntity->getUuid();

        $response = $this->useCase->execute($this->request);

        Assert::assertObjectsEquals($expectedEntity, reset(InMemoryApplicationGateway::$applications));
        /** @var ApplicationResponse $response */
        $expectedResponse = UseCaseResponseAssembler::create(ApplicationResponse::class, $expectedEntity);
        $expectedResponse->owner = UseCaseResponseAssembler::create(UserResponse::class, $expectedEntity->getOwner());
        Assert::assertObjectsEquals($expectedResponse, $response);
    }

    protected function setUp(): void
    {
        /** @var Application $stub */
        $stub = InMemoryFixtureGateway::get('Application1');

        $this->request = $this->buildRequest($stub);

        $this->useCase = new RegisterApplication(
            new ApplicationFactoryImpl(),
            new InMemoryApplicationGateway(),
            new InMemoryUserGateway([$stub->getOwner()])
        );
    }

    private function buildRequest(Application $stub): RegisterApplicationRequest
    {
        return RegisterApplicationRequest::create($stub->getName(), $stub->getOwner()->getId());
    }
}
