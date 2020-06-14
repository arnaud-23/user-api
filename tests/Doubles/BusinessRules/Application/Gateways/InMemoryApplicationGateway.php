<?php

declare(strict_types=1);

namespace App\Doubles\BusinessRules\Application\Gateways;

use App\BusinessRules\Application\Entities\Application;
use App\BusinessRules\Application\Gateways\ApplicationGateway;
use App\Doubles\BusinessRules\EntityModifier;

final class InMemoryApplicationGateway implements ApplicationGateway
{
    /** @var Application[] */
    public static array $application = [];

    public static int $id = 0;

    public static string $uuid = '';

    public function __construct(array $application = [])
    {
        self::$application = $application;
        self::$id = 0;
        self::$uuid = '';
    }

    public function insert(Application $application): void
    {
        EntityModifier::setId($application, self::$id);
        EntityModifier::setProperty($application, 'uuid', self::$uuid);

        self::$application[] = $application;
    }
}
