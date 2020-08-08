<?php

declare(strict_types=1);

namespace App\BusinessRules\Application\Gateways;

use App\BusinessRules\Application\Entities\Application;

interface ApplicationGateway
{
    /** @return Application[] */
    public function findAllByUser(string $userUuid): array;

    public function insert(Application $application): void;
}
