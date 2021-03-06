<?php

declare(strict_types=1);

namespace App\BusinessRules\User\Gateways;

use App\BusinessRules\User\Entities\User;

interface UserGateway
{
    public function emailExist(string $email): bool;

    /** @throws UserNotFoundException */
    public function findByEmail(string $email): User;

    /** @throws UserNotFoundException */
    public function findById(int $id): User;

    /** @throws UserNotFoundException */
    public function findByUuid(string $uuid): User;

    public function insert(User $user): void;

    public function update(User $user): void;
}
