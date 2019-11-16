<?php

namespace App\BusinessRules\User\Responders;

use App\BusinessRules\User\Entities\User;

interface UserResponseAssembler
{
    public function create(User $user): UserResponse;
}