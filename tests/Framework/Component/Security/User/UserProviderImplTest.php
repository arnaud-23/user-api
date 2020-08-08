<?php

declare(strict_types=1);

namespace App\Framework\Component\Security\User;

use App\BusinessRules\User\Entities\User;
use App\Doubles\Assert;
use App\Doubles\BusinessRules\Security\User\Gateways\InMemoryUserSecurityGateway;
use App\Entity\Security\User\UserSecurityCredentialImpl;
use App\Fixtures\InMemoryFixtureGateway;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

final class UserProviderImplTest extends TestCase
{
    private UserProviderImpl $provider;

    /** @test */
    public function notSupportedUserClassReturnFalse(): void
    {
        $result = $this->provider->supportsClass('notSupportedClass');
        $this->assertFalse($result);
    }

    /** @test */
    public function supportedUserClassReturnTrue(): void
    {
        $result = $this->provider->supportsClass(UserSecurityCredentialImpl::class);
        $this->assertTrue($result);
    }

    /** @test */
    public function loadUserNotFoundThrowException(): void
    {
        $this->expectException(UsernameNotFoundException::class);
        $this->expectExceptionMessage("User does not exist with this email: 'email@domaine.ext'");

        InMemoryUserSecurityGateway::$userSecurityCredentials = [];
        $this->provider->loadUserByUsername('email@domaine.ext');
    }

    /** @test */
    public function loadReturnUser(): void
    {
        /** @var User $userStub */
        $userStub = InMemoryFixtureGateway::get('User1');
        $user = $this->provider->loadUserByUsername($userStub->getEmail());

        Assert::assertObjectsEquals(InMemoryFixtureGateway::get('UserSecurityCredential1'), $user);
    }

    /** @test */
    public function refreshUserNotSupportedThrowException(): void
    {
        $this->expectException(UnsupportedUserException::class);
        $this->expectExceptionMessage("Instances of 'Symfony\Component\Security\Core\User\User' are not supported.");
        $this->provider->refreshUser(new \Symfony\Component\Security\Core\User\User('test', 'test'));
    }

    /** @test */
    public function refreshUserNotFoundThrowException(): void
    {
        $this->expectException(UsernameNotFoundException::class);
        $this->expectExceptionMessage("User id '236543' not exist.");

        InMemoryUserSecurityGateway::$userSecurityCredentials = [];
        $this->provider->refreshUser(InMemoryFixtureGateway::get('UserSecurityCredential1'));
    }

    /** @test */
    public function refreshReturnUser(): void
    {
        $uscStub = InMemoryFixtureGateway::get('UserSecurityCredential1');
        $user = $this->provider->refreshUser($uscStub);

        Assert::assertObjectsEquals($uscStub, $user);
    }

    protected function setUp(): void
    {
        $stubs = [InMemoryFixtureGateway::get('UserSecurityCredential1')];
        $this->provider = new UserProviderImpl(new InMemoryUserSecurityGateway($stubs));
    }
}
