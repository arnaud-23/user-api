<?php

declare(strict_types=1);

namespace App\Fixtures;

use Carbon\CarbonImmutable;
use Faker\Provider\DateTime;

final class CustomFakerDataProvider
{
    public static function carbonDateTime(?string $date = null): \DateTimeInterface
    {
        return new CarbonImmutable($date, 'UTC');
    }

    public static function createdAt(): \DateTimeInterface
    {
        $dateTime = DateTime::dateTimeBetween('-200 days', 'now', 'UTC');

        return new CarbonImmutable($dateTime->getTimestamp(), 'UTC');
    }
}
