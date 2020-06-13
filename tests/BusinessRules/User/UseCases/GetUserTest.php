<?php

namespace App\BusinessRules\User\UseCases;

use App\BusinessRules\UseCaseResponseAssembler;
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

    private GetUserRequest $request;

    /** @test */
    public function userNotFoundThrowException(): void
    {
        InMemoryUserGateway::$users = [];
        $this->expectException(UserNotFoundException::class);

        $this->useCase->execute($this->request);
    }

    /** @test */
    public function getUserReturnResponse(): void
    {
        $response = $this->useCase->execute($this->request);

        $expectedResponse = UseCaseResponseAssembler::create(UserResponse::class, InMemoryFixtureGateway::get('User1'));
        Assert::assertObjectsEquals($expectedResponse, $response);
    }

    protected function setUp(): void
    {
        $this->request = $this->buildRequest();

        $this->useCase = new GetUser(
            new InMemoryUserGateway([InMemoryFixtureGateway::get('User1')])
        );
    }

    protected function buildRequest(): GetUserRequest
    {
        return GetUserRequest::create()
            ->withUserId(InMemoryFixtureGateway::get('User1')->getId());
    }
}
