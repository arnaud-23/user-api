<?php

declare(strict_types=1);

namespace App\BusinessRules;

final class UseCaseResponseHydrator
{
    /**
     * @param object $destination
     * @param object $source
     */
    public static function hydrate($destination, $source, array $exclude = []): void
    {
        $sourceAccessibleProperties = array_keys(get_class_vars(get_class($source)));
        foreach ($destination as $field => $var) {
            if (in_array($field, $exclude, true)) {
                continue;
            }
            $getter = self::getFieldGetter($source, $field);
            if ($getter) {
                $destination->$field = $source->$getter();
            } elseif (in_array($field, $sourceAccessibleProperties, true)) {
                $destination->$field = $source->$field;
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
