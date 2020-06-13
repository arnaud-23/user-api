<?php

namespace App\Doubles\BusinessRules\User\Responders;

use App\BusinessRules\User\UseCases\DTO\Response\UserResponseDTO;
use App\Doubles\BusinessRules\User\Entities\UserStub;

class UserResponseStub extends UserResponseDTO
{
    public string $email = UserStub::EMAIL;

    public string $firstName = UserStub::FIRST_NAME;

    public string $lastName = UserStub::LAST_NAME;

    public string $uuid = UserStub::UUID;
}
