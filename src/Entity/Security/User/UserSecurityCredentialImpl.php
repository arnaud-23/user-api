<?php

declare(strict_types=1);

namespace App\Entity\Security\User;

use App\BusinessRules\Security\User\Entities\UserSecurityCredential;
use Symfony\Component\Security\Core\User\UserInterface;

final class UserSecurityCredentialImpl extends UserSecurityCredential implements UserInterface
{
    /** @see UserInterface */
    public function getUsername(): string
    {
        return $this->getUser()->getEmail();
    }

    /** @see UserInterface */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
