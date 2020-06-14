<?php

namespace App\ViewModels;

use App\Doubles\Assert;
use PHPUnit\Framework\TestCase;

final class ViewModelHydratorTest extends TestCase
{
    public function getClassTest(): \Generator
    {
        yield 'source field is public' => [
            $this->getDestinationWithPublicField(),
            $this->getSourceWithPublicField(),
            (object) ['field' => 1],
        ];
        yield 'source field is private' => [
            $this->getDestinationWithPublicField(),
            $this->getSourceWithPrivateField(),
            (object) ['field' => null],
        ];
        yield 'source field does not exist' => [
            $this->getDestinationWithPublicField(),
            $this->getSourceWithoutAnyField(),
            (object) ['field' => null],
        ];
        yield 'source public field with accesseur "get"' => [
            $this->getDestinationWithPublicField(),
            $this->getSourceWithPublicFieldAndAccesseurGet(),
            (object) ['field' => 1],
        ];
        yield 'source private field with accesseur "is"' => [
            $this->getDestinationWithPublicField(),
            $this->getSourceWithPrivateFieldAndAccesseurIs(),
            (object) ['field' => true],
        ];
        yield 'destination field is private' => [
            $this->getDestinationWithPrivateField(),
            $this->getSourceWithPublicField(),
            new class {
                private $field;
            },
        ];
    }

    /** @return object */
    private function getDestinationWithPublicField()
    {
        return new class {
            public $field;
        };
    }

    /** @return object */
    private function getSourceWithPublicField()
    {
        return new class {
            public $field = 1;
        };
    }

    /** @return object */
    private function getSourceWithPrivateField()
    {
        return new class {
            private $field1 = 1;
        };
    }

    /** @return object */
    private function getSourceWithoutAnyField()
    {
        return new class {
        };
    }

    /** @return object */
    private function getSourceWithPublicFieldAndAccesseurGet()
    {
        return new class {
            public $field = 1;

            public function getField(): int
            {
                return $this->field;
            }
        };
    }

    /** @return object */
    private function getSourceWithPrivateFieldAndAccesseurIs()
    {
        return new class {
            private $field = true;

            public function isField(): bool
            {
                return $this->field;
            }
        };
    }

    /** @return object */
    private function getDestinationWithPrivateField()
    {
        return new class {
            private $field;
        };
    }

    /**
     * @test
     * @dataProvider getClassTest
     */
    public function hydrate($destination, $source, $expectedDestination): void
    {
        ViewModelHydrator::hydrate($destination, $source);
        Assert::assertObjectsEquals($expectedDestination, $destination);
    }
}
