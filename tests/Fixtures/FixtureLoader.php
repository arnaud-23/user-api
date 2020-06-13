<?php

declare(strict_types=1);

namespace App\Fixtures;

use Faker\Generator;
use Nelmio\Alice\Loader\NativeLoader;
use Nelmio\Alice\PropertyAccess\ReflectionPropertyAccessor;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

final class FixtureLoader extends NativeLoader
{
    protected function createFakerGenerator(): Generator
    {
        $generator = parent::createFakerGenerator();
        $generator->addProvider(new CustomFakerDataProvider());

        return $generator;
    }

    protected function createPropertyAccessor(): PropertyAccessorInterface
    {
        return new ReflectionPropertyAccessor(parent::createPropertyAccessor());
    }
}
