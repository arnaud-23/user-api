<?php

namespace App\BusinessRules\User\Gateways;

use App\BusinessRules\User\Entities\User;

interface UserGateway
{
    /**
     * @throws UserNotFoundException
     */
    public function findById(int $id): User;

    public function insert(User $user): void;
}