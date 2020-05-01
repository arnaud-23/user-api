<?php

namespace App\Tests\Doubles\BusinessRules\User\Gateways;

use App\BusinessRules\User\Entities\User;
use App\BusinessRules\User\Gateways\UserGateway;
use App\BusinessRules\User\Gateways\UserNotFoundException;
use App\Tests\Doubles\BusinessRules\EntityModifier;

class InMemoryUserGateway implements UserGateway
{
    /**
     * @var User[]
     */
    public static array $users = [];

    public static int $id = 0;

    public static string $uuid = '';

    /**
     * @param User[] $users
     */
    public function __construct(array $users = [])
    {
        self::$users = $users;
        self::$id = 0;
        self::$uuid = '';
    }

    public function insert(User $user): void
    {
        EntityModifier::setId($user, self::$id);
        EntityModifier::setProperty($user, 'uuid', self::$uuid);

        self::$users[] = $user;
    }

    public function findById(int $id): User
    {
        if (!empty(self::$users)) {
            return reset(self::$users);
        }

        throw new UserNotFoundException();
    }
}
