<?php

namespace App\BusinessRules\User\UseCases;

use App\BusinessRules\User\Entities\User;
use App\BusinessRules\User\Requestors\CreateUserRequest;
use App\BusinessRules\User\Responders\UserResponse;
use App\BusinessRules\User\UseCases\DTO\Request\CreateUserRequestBuilderImpl;
use App\BusinessRules\User\UseCases\DTO\Request\CreateUserRequestDTO;
use App\BusinessRules\User\UseCases\DTO\Response\UserResponseAssemblerImpl;
use App\Entity\User\UserFactoryImpl;
use App\Tests\Doubles\BusinessRules\User\Entities\UserStub;
use App\Tests\Doubles\BusinessRules\User\Gateways\InMemoryUserGateway;
use App\Tests\Doubles\BusinessRules\User\Responders\UserResponseStub;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class CreateUserTest extends TestCase
{
    /**
     * @var CreateUserRequestDTO
     */
    private $request;

    /**
     * @var CreateUser
     */
    private $useCase;

    /**
     * @test
     */
    final public function createUserSaveAndReturnUser(): void
    {
        InMemoryUserGateway::$id = UserStub::ID;
        InMemoryUserGateway::$uuid = UserStub::UUID;

        $response = $this->useCase->execute($this->request);

        $this->assertUser(new UserStub(), InMemoryUserGateway::$users->first());
        $this->assertUserResponse(new UserResponseStub(), $response);
    }

    private function assertUser(User $expected, User $actual): void
    {
        Assert::assertSame($expected->getEmail(), $actual->getEmail());
        Assert::assertSame($expected->getFirstName(), $actual->getFirstName());
        Assert::assertSame($expected->getId(), $actual->getId());
        Assert::assertSame($expected->getLastName(), $actual->getLastName());
        Assert::assertSame($expected->getUuid(), $actual->getUuid());
    }

    private function assertUserResponse(UserResponse $expected, UserResponse $actual): void
    {
        Assert::assertSame($expected->getEmail(), $actual->getEmail());
        Assert::assertSame($expected->getFirstName(), $actual->getFirstName());
        Assert::assertSame($expected->getId(), $actual->getId());
        Assert::assertSame($expected->getLastName(), $actual->getLastName());
        Assert::assertSame($expected->getUuid(), $actual->getUuid());
    }

    protected function setUp(): void
    {
        $this->request = $this->buildRequest();

        $this->useCase = new CreateUser(
            new UserFactoryImpl(),
            new InMemoryUserGateway(),
            new UserResponseAssemblerImpl()
        );
    }

    private function buildRequest(): CreateUserRequest
    {
        return (new CreateUserRequestBuilderImpl())
            ->create(UserStub::EMAIL)
            ->withFirstName(UserStub::FIRST_NAME)
            ->withLastName(UserStub::LAST_NAME)
            ->build();
    }
}
