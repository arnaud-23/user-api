<?php

declare(strict_types=1);

namespace App\Framework\Component\Security\User;

use App\BusinessRules\Security\User\Entities\UserSecurityCredential;
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
        /** @var UserSecurityCredential $uscStub */
        $uscStub = InMemoryFixtureGateway::get('UserSecurityCredential1');
        $usc = $this->provider->loadUserByUsername($uscStub->getUser()->getEmail());

        Assert::assertObjectsEquals($uscStub, $usc);
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
        /** @var UserSecurityCredential $usc */
        $usc = InMemoryFixtureGateway::get('UserSecurityCredential1');
        $this->expectException(UsernameNotFoundException::class);
        $this->expectExceptionMessage("User id '{$usc->getUserId()}' not exist.");

        InMemoryUserSecurityGateway::$userSecurityCredentials = [];
        $this->provider->refreshUser($usc);
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
