<?php

namespace App\Entity\User;

use App\BusinessRules\User\Entities\User;
use App\Entity\Security\User\UserSecurityCredentialImpl;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\UserInterface;

class UserImpl extends User implements UserInterface
{
    /** @var UserSecurityCredentialImpl */
    protected $securityCredential;

    public function __construct(string $email)
    {
        parent::__construct($email);
        $this->uuid = Uuid::uuid4()->toString();
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return $this->securityCredential->getRoles();
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->securityCredential->getPassword();
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->securityCredential->getSalt();
    }

    /**
     * @see UserInterface
     */
    public function getUsername()
    {
        return $this->securityCredential->getUsername();
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        return $this->securityCredential->eraseCredentials();
    }

    protected function makeSecurityCredential()
    {
        $this->securityCredential = new UserSecurityCredentialImpl();
    }
}