<?php

namespace App\BusinessRules\User\UseCases;

use App\BusinessRules\Security\User\Entities\UserSecurityCredential;
use App\BusinessRules\UseCaseResponseAssembler;
use App\BusinessRules\User\Entities\User;
use App\BusinessRules\User\Requestors\CreateUserRequest;
use App\BusinessRules\User\Responders\UserResponse;
use App\Doubles\Assert;
use App\Doubles\BusinessRules\Security\User\Gateways\InMemoryUserSecurityGateway;
use App\Doubles\BusinessRules\User\Gateways\InMemoryUserGateway;
use App\Doubles\Symfony\Component\Security\Core\Encoder\UserPasswordEncoderMock;
use App\Entity\Security\User\UserSecurityCredentialFactoryImpl;
use App\Entity\User\UserFactoryImpl;
use App\Fixtures\InMemoryFixtureGateway;
use PHPUnit\Framework\TestCase;

final class CreateUserTest extends TestCase
{
    private const ENCODED_PASSWORD = 'encodedPassword';

    private CreateUserRequest $request;

    private CreateUser $useCase;

    /** @test */
    public function emailAlreadyExistThrowException(): void
    {
        $this->expectException(EmailAlreadyExistException::class);

        /** @var User $expectedUser */
        $expectedUser = InMemoryFixtureGateway::get('User1');
        InMemoryUserGateway::$users = [$expectedUser];

        $this->useCase->execute($this->request);
    }

    /** @test */
    public function createUserSaveAndReturnUser(): void
    {
        /** @var User $expectedUser */
        $expectedUser = InMemoryFixtureGateway::get('User1');
        UserPasswordEncoderMock::$encodedPassword = self::ENCODED_PASSWORD;
        InMemoryUserGateway::$id = $expectedUser->getId();
        InMemoryUserGateway::$uuid = $expectedUser->getUuid();

        $response = $this->useCase->execute($this->request);

        Assert::assertObjectsEquals($expectedUser, reset(InMemoryUserGateway::$users));
        $expectedResponse = UseCaseResponseAssembler::create(UserResponse::class, $expectedUser);
        Assert::assertObjectsEquals($expectedResponse, $response);
        /** @var UserSecurityCredential $credentials */
        $credentials = reset(InMemoryUserSecurityGateway::$userSecurityCredentials);
        Assert::assertSame(self::ENCODED_PASSWORD, $credentials->getPassword());
        Assert::assertIsString($credentials->getSalt());
        Assert::assertObjectsEquals($expectedUser, $credentials->getUser());
    }

    protected function setUp(): void
    {
        $this->request = $this->buildRequest();

        $this->useCase = new CreateUser(
            new UserFactoryImpl(),
            new InMemoryUserGateway(),
            new UserSecurityCredentialFactoryImpl(new UserPasswordEncoderMock()),
            new InMemoryUserSecurityGateway()
        );
    }

    private function buildRequest(): CreateUserRequest
    {
        /** @var User $userStub */
        $userStub = InMemoryFixtureGateway::get('User1');
        /** @var UserSecurityCredential $USCStub */
        $USCStub = InMemoryFixtureGateway::get('UserSecurityCredential1');

        return CreateUserRequest::create($userStub->getEmail())
            ->withFirstName($userStub->getFirstName())
            ->withLastName($userStub->getLastName())
            ->withPassword($USCStub->getPassword());
    }
}
