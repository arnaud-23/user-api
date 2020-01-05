<?php

namespace App\Framework\Component\Security\User;

use App\BusinessRules\Security\User\Gateways\UserSecurityCredentialGateway;
use App\BusinessRules\Security\User\Gateways\UserSecurityCredentialsNotFoundException;
use App\Entity\User\UserImpl;
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
    public function loadUserByUsername($email)
    {
        try {
            $userSecurityCredential = $this->userSecurityCredentialGateway->findByEmail($email);
            return $userSecurityCredential->getUser();
        } catch (UserSecurityCredentialsNotFoundException $e) {
            throw new UsernameNotFoundException("User does not exist with this email: '{$email}'");
        }
    }

    /**
     * @inheritDoc
     */
    public function refreshUser(UserInterface $user)
    {
        try {
            if (!$user instanceof UserImpl) {
                $class = get_class($user);
                throw new UnsupportedUserException("Instances of '{$class}' are not supported.");
            }
            $userSecurityCredential = $this->userSecurityCredentialGateway->findById($user->getId());
            return $userSecurityCredential->getUser();
        } catch (UserSecurityCredentialsNotFoundException $e) {
            throw new UsernameNotFoundException("User id '{$user->getId()}' not exist.");
        }
    }

    /**
     * @inheritDoc
     */
    public function supportsClass($class)
    {
        return UserImpl::class === $class;
    }
}