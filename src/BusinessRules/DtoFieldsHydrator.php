<?php

namespace App\BusinessRules;

abstract class DtoFieldsHydrator
{
    public static function hydrate($dto, $object): void
    {
        $reflectedDTO = new \ReflectionClass($dto);
        $reflectedObject = new \ReflectionClass($object);
        foreach ($reflectedDTO->getProperties() as $dtoProperty) {
            $dtoPropertyName = $dtoProperty->getName();
            $value = self::getPropertyValue($object, $dtoPropertyName, $reflectedObject);
            $dto->$dtoPropertyName = $value;
        }
    }

    private static function getPropertyValue($object, string $dtoPropertyName, \ReflectionClass $reflectedObject)
    {
        foreach (['get', 'is'] as $prefix) {
            $methodName = $prefix . ucfirst($dtoPropertyName);
            if ($reflectedObject->hasMethod($methodName)) {
                return $object->$methodName();
            }
        }

        return $object->$dtoPropertyName;
    }
}