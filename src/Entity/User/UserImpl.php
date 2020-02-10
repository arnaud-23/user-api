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
    public function getRoles(): array
    {
        return $this->securityCredential->getRoles();
    }

    /**
     * @inheritDoc
     */
    public function getPassword(): string
    {
        return $this->securityCredential->getPassword();
    }

    /**
     * @inheritDoc
     */
    public function getSalt(): string
    {
        return $this->securityCredential->getSalt();
    }

    /**
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return $this->securityCredential->getUsername();
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        $this->securityCredential->eraseCredentials();
    }

    protected function makeSecurityCredential(): void
    {
        $this->securityCredential = new UserSecurityCredentialImpl();
    }
}
