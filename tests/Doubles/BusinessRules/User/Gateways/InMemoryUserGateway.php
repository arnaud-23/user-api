<?php

declare(strict_types=1);

namespace App\Doubles\BusinessRules\User\Gateways;

use App\BusinessRules\User\Entities\User;
use App\BusinessRules\User\Gateways\UserGateway;
use App\BusinessRules\User\Gateways\UserNotFoundException;
use App\Doubles\BusinessRules\EntityModifier;

final class InMemoryUserGateway implements UserGateway
{
    /** @var User[] */
    public static array $users = [];

    public static int $id = 0;

    public static string $uuid = '';

    public function __construct(array $users = [])
    {
        self::$users = $users;
        self::$id = 0;
        self::$uuid = '';
    }

    public function emailExist(string $email): bool
    {
        return !empty(self::$users);
    }

    public function findByEmail(string $email): User
    {
        return $this->findOneOrThrowException();
    }

    private function findOneOrThrowException(): User
    {
        if (!empty(self::$users)) {
            return reset(self::$users);
        }

        throw new UserNotFoundException();
    }

    public function findById(int $id): User
    {
        return $this->findOneOrThrowException();
    }

    public function findByUuid(string $uuid): User
    {
        return $this->findOneOrThrowException();
    }

    public function insert(User $user): void
    {
        EntityModifier::setId($user, self::$id);
        EntityModifier::setProperty($user, 'uuid', self::$uuid);

        self::$users[] = $user;
    }

    public function update(User $user): void
    {
        self::$users[] = $user;
    }
}
