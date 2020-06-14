<?php

namespace App\BusinessRules\Application\Gateways;

use App\BusinessRules\Application\Entities\Application;

interface ApplicationGateway
{
    public function insert(Application $application): void;
}
