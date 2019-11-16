<?php

namespace App\Tests\Doubles\BusinessRules;

final class EntityModifier
{
    public static function setId($entity, $value): void
    {
        self::setProperty($entity, 'id', $value);
    }

    public static function setProperty($entity, string $name, $value): void
    {
        $property = new \ReflectionProperty(get_class($entity), $name);
        $property->setAccessible(true);
        $property->setValue($entity, $value);
    }
}