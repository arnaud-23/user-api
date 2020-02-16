<?php

declare(strict_types=1);

namespace App\EventListener\Framework\Trikoder\OAuth2;

use App\BusinessRules\Security\User\Gateways\UserSecurityCredentialGateway;
use App\BusinessRules\User\Entities\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Trikoder\Bundle\OAuth2Bundle\Event\UserResolveEvent;

final class UserResolveListener
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    /**
     * @var UserProviderInterface
     */
    private $userProvider;

    /**
     * @var UserSecurityCredentialGateway
     */
    private $userSecurityCredentialGateway;

    public function __construct(
        UserPasswordEncoderInterface $userPasswordEncoder,
        UserProviderInterface $userProvider,
        UserSecurityCredentialGateway $userSecurityCredentialGateway
    ) {
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->userProvider = $userProvider;
        $this->userSecurityCredentialGateway = $userSecurityCredentialGateway;
    }

    public function onUserResolve(UserResolveEvent $event): void
    {
        /** @var User $user */
        $user = $this->userProvider->loadUserByUsername($event->getUsername());

        if (null === $user) {
            return;
        }

        $userSecurityCredential = $this->userSecurityCredentialGateway->findById($user->getId());

        $raw = sprintf($userSecurityCredential->getSalt(), $event->getPassword());

        if (!$this->userPasswordEncoder->isPasswordValid($userSecurityCredential, $raw)) {
            return;
        }

        $event->setUser($userSecurityCredential);
    }
}
