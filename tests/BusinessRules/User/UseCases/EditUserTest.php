<?php

declare(strict_types=1);

namespace App\BusinessRules\User\UseCases;

use App\BusinessRules\UseCaseResponseAssembler;
use App\BusinessRules\User\Entities\User;
use App\BusinessRules\User\Gateways\UserNotFoundException;
use App\BusinessRules\User\Requestors\EditUserRequest;
use App\BusinessRules\User\Responders\UserResponse;
use App\Doubles\Assert;
use App\Doubles\BusinessRules\User\Gateways\InMemoryUserGateway;
use App\Fixtures\InMemoryFixtureGateway;
use PHPUnit\Framework\TestCase;

final class EditUserTest extends TestCase
{
    private EditUser $useCase;

    /** @test */
    public function userDoesNotExistThroughNotFoundException(): void
    {
        $this->expectException(UserNotFoundException::class);
        InMemoryUserGateway::$users = [];
        /** @var User $user */
        $user = InMemoryFixtureGateway::get('User1');
        $this->useCase->execute(EditUserRequest::create($user->getUuid()));
    }

    /** @test */
    public function updateUserPartially(): void
    {
        /** @var User $expectedUser */
        $expectedUser = InMemoryFixtureGateway::get('User1');
        $updatedFirstName = 'George';
        $this->useCase->execute(
            EditUserRequest::create($expectedUser->getUuid())
                ->withFirstName($updatedFirstName)
        );

        $user = reset(InMemoryUserGateway::$users);
        Assert::assertObjectsEquals($expectedUser, $user, ['firstName']);
        Assert::assertNotSame($expectedUser->getFirstName(), $user->getFirstName());
        Assert::assertSame($updatedFirstName, $user->getFirstName());
    }

    /** @test */
    public function updateFullyUser(): void
    {
        /** @var User $originalUser */
        $originalUser = InMemoryFixtureGateway::get('User1');
        /** @var User $expectedUser */
        $expectedUser = InMemoryFixtureGateway::get('User2');

        $userResponse = $this->useCase->execute(
            EditUserRequest::create($originalUser->getUuid())
                ->withFirstName($expectedUser->getFirstName())
                ->withLastName($expectedUser->getLastName())
        );

        $user = reset(InMemoryUserGateway::$users);
        Assert::assertObjectsEquals($originalUser, $user, ['firstName', 'lastName']);
        $this->assertOriginalAndUpdatedPropertiesNotSame($originalUser, $user);
        $this->assertExpectedAndUpdatedPropertiesSame($expectedUser, $user);

        /** @var UserResponse $expectedResponse */
        $expectedResponse = UseCaseResponseAssembler::create(UserResponse::class, $user, ['firstName', 'lastName']);
        $expectedResponse->firstName = $expectedUser->getFirstName();
        $expectedResponse->lastName = $expectedUser->getLastName();
        Assert::assertObjectsEquals($expectedResponse, $userResponse);
    }

    private function assertOriginalAndUpdatedPropertiesNotSame(User $original, User $actual): void
    {
        Assert::assertNotSame($original->getFirstName(), $actual->getFirstName());
        Assert::assertNotSame($original->getLastName(), $actual->getLastName());
    }

    private function assertExpectedAndUpdatedPropertiesSame(User $expected, User $actual): void
    {
        Assert::assertSame($expected->getFirstName(), $actual->getFirstName());
        Assert::assertSame($expected->getLastName(), $actual->getLastName());
    }

    protected function setUp(): void
    {
        $this->useCase = new EditUser(
            new InMemoryUserGateway([InMemoryFixtureGateway::get('User1')])
        );
    }
}
