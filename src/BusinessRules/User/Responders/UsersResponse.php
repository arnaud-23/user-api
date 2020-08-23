<?php

declare(strict_types=1);

namespace App\BusinessRules\User\Responders;

use App\BusinessRules\UseCaseResponse;

final class UsersResponse implements UseCaseResponse
{
    /** @var UserResponse[] */
    public array $users = [];

    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public static function create(array $users)
    {
        return new self($users);
    }

    /** @return UserResponse[] */
    public function getUsers(): array
    {
        return $this->users;
    }
}
