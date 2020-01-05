<?php

namespace App\Tests\Framework\Component\Security\User;

use App\Entity\User\UserImpl;
use App\Framework\Component\Security\User\UserProviderImpl;
use App\Tests\Doubles\BusinessRules\Security\User\Entities\UserSecurityCredentialStub;
use App\Tests\Doubles\BusinessRules\Security\User\Gateways\InMemoryUserSecurityGateway;
use App\Tests\Doubles\BusinessRules\User\Entities\UserStub;
use App\Tests\Doubles\BusinessRules\User\Entities\UserTestCase;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

final class UserProviderImplTest extends TestCase
{
    use UserTestCase;

    /** @var UserProviderImpl */
    private $provider;

    /**
     * @test
     */
    public function notSupportedUserClassReturnFalse(): void
    {
        $result = $this->provider->supportsClass('notSupportedClass');
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function supportedUserClassReturnTrue(): void
    {
        $result = $this->provider->supportsClass(UserImpl::class);
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function loadUserNotFoundThrowException(): void
    {
        $this->expectException(UsernameNotFoundException::class);
        $this->expectExceptionMessage("User does not exist with this email: 'email@domaine.ext'");

        InMemoryUserSecurityGateway::$userSecurityCredentials = [];
        $this->provider->loadUserByUsername('email@domaine.ext');
    }

    /**
     * @test
     */
    public function loadReturnUser(): void
    {
        $user = $this->provider->loadUserByUsername(UserStub::EMAIL);

        $this->assertUser(new UserStub(), $user);
    }

    /**
     * @test
     */
    public function refreshUserNotSupportedThrowException(): void
    {
        $this->expectException(UnsupportedUserException::class);
        $this->expectExceptionMessage("Instances of 'Symfony\Component\Security\Core\User\User' are not supported.");
        $this->provider->refreshUser(new \Symfony\Component\Security\Core\User\User('test', 'test'));
    }

    /**
     * @test
     */
    public function refreshUserNotFoundThrowException(): void
    {
        $this->expectException(UsernameNotFoundException::class);
        $this->expectExceptionMessage("User id '236543' not exist.");

        InMemoryUserSecurityGateway::$userSecurityCredentials = [];
        $this->provider->refreshUser(new UserStub());
    }

    /**
     * @test
     */
    public function refreshReturnUser(): void
    {
        $user = $this->provider->refreshUser(new UserStub());

        $this->assertUser(new UserStub(), $user);
    }

    protected function setUp(): void
    {
        $stubs = [UserSecurityCredentialStub::USER_ID => new UserSecurityCredentialStub()];
        $this->provider = new UserProviderImpl(new InMemoryUserSecurityGateway($stubs));
    }
}
