<?php

namespace App\Doubles\BusinessRules\User\Entities;

use App\Entity\User\UserImpl;

class UserStub extends UserImpl
{
    public const EMAIL = 'john.doe@mail.com';

    public const FIRST_NAME = 'John';

    public const ID = 236543;

    public const LAST_NAME = 'Doe';

    public const UUID = 'gdsfg2jqzl5febfvn6sk2r2esfe6bhv234uhn5g';

    protected $email = self::EMAIL;

    protected $firstName = self::FIRST_NAME;

    protected $id = self::ID;

    protected $lastName = self::LAST_NAME;

    protected $uuid = self::UUID;

    public function __construct()
    {
    }
}
