<?php

declare(strict_types=1);

namespace App\Entity\Security\User;

use App\BusinessRules\Security\User\Entities\UserSecurityCredential;
use App\BusinessRules\Security\User\Entities\UserSecurityCredentialFactory;
use App\BusinessRules\User\Entities\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class UserSecurityCredentialFactoryImpl implements UserSecurityCredentialFactory
{
    /** @var UserPasswordEncoderInterface */
    private $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoderInterface)
    {
        $this->userPasswordEncoder = $userPasswordEncoderInterface;
    }

    public function create(User $user, string $password): UserSecurityCredential
    {
        $userSecurityCredential = new UserSecurityCredentialImpl($user);
        $userSecurityCredential->setSalt($this->generateSalt());
        $encodedPassword = $this->getEncodedPassword($userSecurityCredential, $password);
        $userSecurityCredential->setPassword($encodedPassword);

        return $userSecurityCredential;
    }

    private function getEncodedPassword(UserInterface $userSecurityCredential, string $plainPassword): string
    {
        $raw = sprintf($userSecurityCredential->getSalt(), $plainPassword);

        return $this->userPasswordEncoder->encodePassword($userSecurityCredential, $raw);
    }

    private function generateSalt(): string
    {
        return base64_encode(random_bytes(12)) . '%s' . base64_encode(random_bytes(12));
    }
}
