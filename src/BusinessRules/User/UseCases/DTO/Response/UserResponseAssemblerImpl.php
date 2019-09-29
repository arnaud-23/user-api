<?php

namespace App\BusinessRules\User\UseCases\DTO\Response;

use App\BusinessRules\User\Entities\User;
use App\BusinessRules\User\Responders\UserResponse;
use App\BusinessRules\User\Responders\UserResponseAssembler;

class UserResponseAssemblerImpl implements UserResponseAssembler
{
    public function create(User $user): UserResponse
    {
        $response = new UserResponseDTO();
        $response->email = $user->getEmail();
        $response->firstName = $user->getFirstName();
        $response->id = $user->getId();
        $response->lastName = $user->getLastName();
        $response->uuid = $user->getUuid();

        return $response;
    }
}