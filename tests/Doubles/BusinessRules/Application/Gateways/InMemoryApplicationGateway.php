<?php

declare(strict_types=1);

namespace App\Doubles\BusinessRules\Application\Gateways;

use App\BusinessRules\Application\Entities\Application;
use App\BusinessRules\Application\Gateways\ApplicationGateway;
use App\Doubles\BusinessRules\EntityModifier;

final class InMemoryApplicationGateway implements ApplicationGateway
{
    /** @var Application[] */
    public static array $applications = [];

    public static int $id = 0;

    public static string $uuid = '';

    public function __construct(array $applications = [])
    {
        self::$applications = $applications;
        self::$id = 0;
        self::$uuid = '';
    }

    public function findAllByUser(string $userUuid): array
    {
        return self::$applications;
    }

    public function insert(Application $application): void
    {
        EntityModifier::setId($application, self::$id);
        EntityModifier::setProperty($application, 'uuid', self::$uuid);

        self::$applications[] = $application;
    }
}
