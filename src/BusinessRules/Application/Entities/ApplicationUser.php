<?php

declare(strict_types=1);

namespace App\BusinessRules\Application\Entities;

use App\BusinessRules\User\Entities\User;

abstract class ApplicationUser
{
    protected Application $application;

    protected int $id;

    protected User $user;

    public function __construct(Application $application, User $user)
    {
        $this->application = $application;
        $this->user = $user;
    }

    final public function getApplication(): Application
    {
        return $this->application;
    }

    final public function getUser(): User
    {
        return $this->user;
    }
}
