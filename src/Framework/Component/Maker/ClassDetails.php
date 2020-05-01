<?php

declare(strict_types=1);

namespace App\Framework\Component\Maker;

use ReflectionClass;
use ReflectionMethod;
use Symfony\Bundle\MakerBundle\Str;
use function strlen;

final class ClassDetails
{
    private string $fullClassName;

    public function __construct(string $fullClassName)
    {
        $this->fullClassName = $fullClassName;
    }

    public function getFullName(): string
    {
        return $this->fullClassName;
    }

    public function getShortName(): string
    {
        return Str::getShortClassName($this->fullClassName);
    }

    public function getProperties(): array
    {
        $reflect = new ReflectionClass($this->fullClassName);
        $methods = $reflect->getMethods();

        $propertiesList = [];

        foreach ($methods as $method) {
            $typeOptions = [
                'allowsNull' => $method->getReturnType()->allowsNull(),
                'type'       => $method->getReturnType()->getName(),
            ];

            $propertyName = $this->getPropertyName($method);
            $propertiesList[$propertyName] = $typeOptions;
        }

        return $propertiesList;
    }

    private function getPropertyName(ReflectionMethod $method): string
    {
        $name = $this->removePrefixes($method->getName(), ['get', 'set']);

        return Str::asLowerCamelCase($name);
    }

    private function removePrefixes(string $value, array $prefixes): string
    {
        foreach ($prefixes as $prefix) {
            if ($this->hasPrefix($value, $prefix)) {
                return substr($value, strlen($prefix));
            }
        }

        return $value;
    }

    private function hasPrefix(string $value, string $prefix): bool
    {
        return 0 === strcasecmp($prefix, substr($value, 0, strlen($prefix)));
    }

    public function getPath(): string
    {
        return (new ReflectionClass($this->fullClassName))->getFileName();
    }
}
