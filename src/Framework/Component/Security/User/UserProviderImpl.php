<?php

namespace App\Framework\Component\Security\User;

use App\BusinessRules\Security\User\Gateways\UserSecurityCredentialGateway;
use App\BusinessRules\Security\User\Gateways\UserSecurityCredentialsNotFoundException;
use App\Entity\Security\User\UserSecurityCredentialImpl;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProviderImpl implements UserProviderInterface
{
    /** @var UserSecurityCredentialGateway */
    private $userSecurityCredentialGateway;

    public function __construct(UserSecurityCredentialGateway $userSecurityCredentialGateway)
    {
        $this->userSecurityCredentialGateway = $userSecurityCredentialGateway;
    }

    /**
     * @inheritDoc
     */
    public function loadUserByUsername($email): UserInterface
    {
        try {
            return $this->userSecurityCredentialGateway->findByEmail($email);
        } catch (UserSecurityCredentialsNotFoundException $e) {
            throw new UsernameNotFoundException("User does not exist with this email: '{$email}'");
        }
    }

    /**
     * @inheritDoc
     */
    public function refreshUser(UserInterface $user): UserInterface
    {
        try {
            if (!$user instanceof UserSecurityCredentialImpl) {
                $class = get_class($user);
                throw new UnsupportedUserException("Instances of '{$class}' are not supported.");
            }

            return $this->userSecurityCredentialGateway->findById($user->getUserId());
        } catch (UserSecurityCredentialsNotFoundException $e) {
            throw new UsernameNotFoundException("User id '{$user->getUserId()}' not exist.");
        }
    }

    /**
     * @inheritDoc
     */
    public function supportsClass($class): bool
    {
        return UserSecurityCredentialImpl::class === $class;
    }
}
