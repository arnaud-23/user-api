<?php

namespace App\Doubles\BusinessRules\Security\User\Entities;

use App\Entity\Security\User\UserSecurityCredentialImpl;
use App\Doubles\BusinessRules\User\Entities\UserStub;
use Carbon\CarbonImmutable;

final class UserSecurityCredentialStub extends UserSecurityCredentialImpl
{
    public const CREATED_AT = '2017-04-12 13:43:56';

    public const SALT = 'salt';

    public const PASSWORD = 'password';

    public const ROLES = ['ROLE_USER'];

    public const USER_ID = UserStub::ID;

    protected $password = self::PASSWORD;

    protected $roles = self::ROLES;

    protected $salt = self::SALT;

    public function __construct()
    {
        $this->createdAt = new CarbonImmutable(self::CREATED_AT);
        $this->user = new UserStub();
    }
}
