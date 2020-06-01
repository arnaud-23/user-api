<?php

namespace App\BusinessRules\User\UseCases\DTO\Response;

use App\BusinessRules\UseCaseResponseAssembler;
use App\BusinessRules\User\Entities\User;
use App\BusinessRules\User\Responders\UserResponse;
use App\BusinessRules\User\Responders\UserResponseAssembler;

class UserResponseAssemblerImpl implements UserResponseAssembler
{
    public function create(User $user): UserResponse
    {
        return UseCaseResponseAssembler::create(UserResponseDTO::class, $user);
    }
}
