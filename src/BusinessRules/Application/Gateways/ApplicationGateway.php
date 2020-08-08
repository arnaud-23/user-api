<?php

declare(strict_types=1);

namespace App\BusinessRules\Application\Gateways;

use App\BusinessRules\Application\Entities\Application;

interface ApplicationGateway
{
    public function insert(Application $application): void;
}
