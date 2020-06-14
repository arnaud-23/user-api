<?php

namespace App\BusinessRules;

final class UseCaseResponseHydrator
{
    /**
     * @param object $destination
     * @param object $source
     */
    public static function hydrate($destination, $source): void
    {
        $sourceAccessibleProperties = array_keys(get_class_vars(get_class($source)));
        foreach ($destination as $field => $var) {
            $getter = self::getFieldGetter($source, $field);
            if ($getter) {
                $sourceFieldValue = $source->$getter();
            } elseif (in_array($field, $sourceAccessibleProperties, true)) {
                $sourceFieldValue = $source->$field;
            } else {
                $sourceFieldValue = null;
            }

            if (is_object($sourceFieldValue)) {
                $sourceFieldValue = $sourceFieldValue->getUuid();
            }
            $destination->$field = $sourceFieldValue;
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
