<?php

declare(strict_types=1);

namespace App\Fixtures;

final class InMemoryFixtureGateway
{
    private static $objects;

    /** @return object */
    public static function get(string $key)
    {
        if (!self::has($key)) {
            throw new \RuntimeException("No fixture with key '$key' found.");
        }

        return self::$objects[$key];
    }

    public static function has(string $key): bool
    {
        return isset(self::$objects[$key]);
    }

    public static function load(): void
    {
        $loader = new FixtureLoader();
        self::$objects = $loader->loadFile(__DIR__ . '/fixtures.yaml')->getObjects();
    }
}
