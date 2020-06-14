<?php

namespace App\BusinessRules\Application\Entities;

use App\BusinessRules\User\Entities\User;

interface ApplicationFactory
{
    public function create(User $owner, string $name): Application;
}
