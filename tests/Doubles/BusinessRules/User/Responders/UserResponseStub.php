<?php

namespace App\Tests\Doubles\BusinessRules\User\Responders;

use App\BusinessRules\User\UseCases\DTO\Response\UserResponseDTO;
use App\Tests\Doubles\BusinessRules\User\Entities\UserStub;

class UserResponseStub extends UserResponseDTO
{
    public $email = UserStub::EMAIL;

    public $firstName = UserStub::FIRST_NAME;

    public $id = UserStub::ID;

    public $lastName = UserStub::LAST_NAME;

    public $uuid = UserStub::UUID;
}