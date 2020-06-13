<?php

namespace App\BusinessRules\User\UseCases;

use App\BusinessRules\Security\User\Entities\UserSecurityCredential;
use App\BusinessRules\User\Requestors\CreateUserRequest;
use App\BusinessRules\User\UseCases\DTO\Request\CreateUserRequestBuilderImpl;
use App\BusinessRules\User\UseCases\DTO\Request\CreateUserRequestDTO;
use App\BusinessRules\User\UseCases\DTO\Response\UserResponseAssemblerImpl;
use App\Entity\Security\User\UserSecurityCredentialFactoryImpl;
use App\Entity\User\UserFactoryImpl;
use App\Doubles\Assert;
use App\Doubles\BusinessRules\Security\User\Entities\UserSecurityCredentialStub;
use App\Doubles\BusinessRules\Security\User\Gateways\InMemoryUserSecurityGateway;
use App\Doubles\BusinessRules\User\Entities\UserStub;
use App\Doubles\BusinessRules\User\Gateways\InMemoryUserGateway;
use App\Doubles\BusinessRules\User\Responders\UserResponseStub;
use App\Doubles\Symfony\Component\Security\Core\Encoder\UserPasswordEncoderMock;
use PHPUnit\Framework\TestCase;

class CreateUserTest extends TestCase
{
    const ENCODED_PASSWORD = 'encodedPassword';

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
        UserPasswordEncoderMock::$encodedPassword = self::ENCODED_PASSWORD;
        InMemoryUserGateway::$id = UserStub::ID;
        InMemoryUserGateway::$uuid = UserStub::UUID;

        $response = $this->useCase->execute($this->request);

        Assert::assertObjectsEquals(new UserStub(), reset(InMemoryUserGateway::$users));
        Assert::assertObjectsEquals(new UserResponseStub(), $response);
        /** @var UserSecurityCredential $credentials */
        $credentials = reset(InMemoryUserSecurityGateway::$userSecurityCredentials);
        Assert::assertSame(self::ENCODED_PASSWORD, $credentials->getPassword());
        Assert::assertIsString($credentials->getSalt());
        Assert::assertObjectsEquals(new UserStub(), $credentials->getUser());
    }

    protected function setUp(): void
    {
        $this->request = $this->buildRequest();

        $this->useCase = new CreateUser(
            new UserFactoryImpl(),
            new InMemoryUserGateway(),
            new UserSecurityCredentialFactoryImpl(new UserPasswordEncoderMock()),
            new InMemoryUserSecurityGateway(),
            new UserResponseAssemblerImpl()
        );
    }

    private function buildRequest(): CreateUserRequest
    {
        return (new CreateUserRequestBuilderImpl())
            ->create(UserStub::EMAIL)
            ->withFirstName(UserStub::FIRST_NAME)
            ->withLastName(UserStub::LAST_NAME)
            ->withPassword(UserSecurityCredentialStub::PASSWORD)
            ->build();
    }
}
