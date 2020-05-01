<?php

namespace App\Tests\BusinessRules\User\UseCases;

use App\BusinessRules\User\Gateways\UserNotFoundException;
use App\BusinessRules\User\Requestors\GetUserRequest;
use App\BusinessRules\User\UseCases\DTO\Request\GetUserRequestBuilderImpl;
use App\BusinessRules\User\UseCases\DTO\Response\UserResponseAssemblerImpl;
use App\BusinessRules\User\UseCases\GetUser;
use App\Tests\Doubles\Assert;
use App\Tests\Doubles\BusinessRules\User\Entities\UserStub;
use App\Tests\Doubles\BusinessRules\User\Gateways\InMemoryUserGateway;
use App\Tests\Doubles\BusinessRules\User\Responders\UserResponseStub;
use PHPUnit\Framework\TestCase;

final class GetUserTest extends TestCase
{
    private GetUser $useCase;

    private GetUserRequest $request;

    /**
     * @test
     */
    public function userNotFoundThrowException(): void
    {
        InMemoryUserGateway::$users = [];
        $this->expectException(UserNotFoundException::class);

        $this->useCase->execute($this->request);
    }

    /**
     * @test
     */
    public function getUserReturnResponse(): void
    {
        $response = $this->useCase->execute($this->request);

        Assert::assertObjectsEquals(new UserResponseStub(), $response);
    }

    protected function setUp(): void
    {
        $this->request = $this->buildRequest();

        $this->useCase = new GetUser(
            new InMemoryUserGateway([new UserStub()]),
            new UserResponseAssemblerImpl()
        );
    }

    protected function buildRequest(): GetUserRequest
    {
        return (new GetUserRequestBuilderImpl())
            ->create()
            ->withUserId(UserStub::ID)
            ->build();
    }
}
