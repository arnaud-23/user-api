<?php

namespace App\Entity\Security\User;

use App\BusinessRules\Security\User\Entities\UserSecurityCredential;
use Symfony\Component\Security\Core\User\UserInterface;

class UserSecurityCredentialImpl extends UserSecurityCredential implements UserInterface
{
    /**
     * @see UserInterface
     */
    public function getUsername(): string
    {
        $this->getUser()->getEmail();
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
