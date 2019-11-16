<?php

namespace App\Tests\Doubles\BusinessRules\User\Entities;

use App\Entity\User\UserImpl;
use Carbon\Carbon;

class UserStub extends UserImpl
{
    const EMAIL = 'john.doe@mail.com';

    const FIRST_NAME = 'John';

    const ID = 236543;

    const LAST_NAME = 'Doe';

    const UUID = 'gdsfg2jqzl5febfvn6sk2r2esfe6bhv234uhn5g';

    const CREATED_AT = '2017-04-12 13:43:56';

    protected $email = self::EMAIL;

    protected $firstName = self::FIRST_NAME;

    protected $id = self::ID;

    protected $lastName = self::LAST_NAME;

    protected $uuid = self::UUID;

    public function __construct()
    {
        $this->createdAt = new Carbon(self::CREATED_AT);
    }
}