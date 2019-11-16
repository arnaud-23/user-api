<?php

namespace App\BusinessRules\User\Gateways;

use App\BusinessRules\User\Entities\User;

interface UserGateway
{
    public function insert(User $user): void;
}