<?php

namespace App\BusinessRules;

final class UseCaseResponseHydrator
{
    /**
     * @param object $response
     * @param object $entity
     */
    public static function hydrate($response, $entity): void
    {
        $accessibleProperties = array_keys(get_class_vars(get_class($entity)));
        foreach ($response as $field => $var) {
            $getter = self::getFieldGetter($entity, $field);
            if ($getter) {
                $response->$field = $entity->$getter();
            } elseif (in_array($field, $accessibleProperties, true)) {
                $response->$field = $entity->$field;
            }
        }
    }

    /** @param object $source */
    private static function getFieldGetter($source, string $field): ?string
    {
        foreach (['get', 'is'] as $prefix) {
            $getter = $prefix . ucfirst($field);
            if (method_exists($source, $getter)) {
                return $getter;
            }
        }

        return null;
    }
}
