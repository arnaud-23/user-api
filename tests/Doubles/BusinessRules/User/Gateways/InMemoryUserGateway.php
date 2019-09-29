<?php

namespace App\Tests\Doubles\BusinessRules\User\Gateways;

use App\BusinessRules\User\Entities\User;
use App\BusinessRules\User\Gateways\UserGateway;
use App\Tests\Doubles\BusinessRules\EntityModifier;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class InMemoryUserGateway implements UserGateway
{
    /**
     * @var User[]|Collection
     */
    public static $users = [];

    /**
     * @var int
     */
    public static $id = 0;

    /**
     * @var string
     */
    public static $uuid = '';

    /**
     * @param User[] $users
     */
    public function __construct(array $users = [])
    {
        self::$users = new ArrayCollection($users);
        self::$id = 0;
        self::$uuid = '';
    }

    public function insert(User $user): void
    {
        EntityModifier::setId($user, self::$id);
        EntityModifier::setProperty($user, 'uuid', self::$uuid);

        self::$users->add($user);
    }
}