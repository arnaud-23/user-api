<?php

namespace App\BusinessRules\User\UseCases;

use App\BusinessRules\InvalidRequestException;
use App\BusinessRules\UseCaseResponseAssembler;
use App\BusinessRules\User\Entities\User;
use App\BusinessRules\User\Gateways\UserNotFoundException;
use App\BusinessRules\User\Requestors\GetUserRequest;
use App\BusinessRules\User\Responders\UserResponse;
use App\Doubles\Assert;
use App\Doubles\BusinessRules\User\Gateways\InMemoryUserGateway;
use App\Fixtures\InMemoryFixtureGateway;
use PHPUnit\Framework\TestCase;

final class GetUserTest extends TestCase
{
    private GetUser $useCase;

    /** @test */
    public function userByIdNotFoundThrowException(): void
    {
        InMemoryUserGateway::$users = [];
        $this->expectException(UserNotFoundException::class);

        /** @var User $userStub */
        $userStub = InMemoryFixtureGateway::get('User1');
        $this->useCase->execute(
            GetUserRequest::create()->withUserId($userStub->getId())
        );
    }

    /** @test */
    public function userByUuidNotFoundThrowException(): void
    {
        InMemoryUserGateway::$users = [];
        $this->expectException(UserNotFoundException::class);

        /** @var User $userStub */
        $userStub = InMemoryFixtureGateway::get('User1');
        $this->useCase->execute(
            GetUserRequest::create()->withUserUuid($userStub->getUuid())
        );
    }

    /** @test */
    public function getUserByIdReturnResponse(): void
    {
        /** @var User $userStub */
        $userStub = InMemoryFixtureGateway::get('User1');
        $response = $this->useCase->execute(
            GetUserRequest::create()->withUserId($userStub->getId())
        );

        $expectedResponse = UseCaseResponseAssembler::create(UserResponse::class, $userStub);
        Assert::assertObjectsEquals($expectedResponse, $response);
    }

    /** @test */
    public function getUserByUuidReturnResponse(): void
    {
        /** @var User $userStub */
        $userStub = InMemoryFixtureGateway::get('User1');
        $response = $this->useCase->execute(
            GetUserRequest::create()->withUserUuid($userStub->getUuid())
        );

        $expectedResponse = UseCaseResponseAssembler::create(UserResponse::class, $userStub);
        Assert::assertObjectsEquals($expectedResponse, $response);
    }

    /** @test */
    public function requestWithoutParameterThrowException(): void
    {
        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage('parameter "userUuid" or "userId" should be defined.');

        $this->useCase->execute(GetUserRequest::create());
    }

    protected function setUp(): void
    {
        $this->useCase = new GetUser(
            new InMemoryUserGateway([InMemoryFixtureGateway::get('User1')])
        );
    }
}
