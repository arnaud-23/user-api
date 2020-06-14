<?php

declare(strict_types=1);

namespace App\Entity\Application;

use App\BusinessRules\Application\Entities\Application;
use App\BusinessRules\Application\Entities\ApplicationFactory;
use App\BusinessRules\User\Entities\User;

final class ApplicationFactoryImpl implements ApplicationFactory
{
    public function create(User $owner, string $name): Application
    {
        return new ApplicationImpl($owner, $name);
    }
}
