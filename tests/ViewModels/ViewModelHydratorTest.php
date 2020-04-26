<?php

namespace App\Tests\ViewModels;

use App\Tests\Doubles\Assert;
use App\ViewModels\ViewModelHydrator;
use PHPUnit\Framework\TestCase;

final class ViewModelHydratorTest extends TestCase
{
    /**
     * @var object
     */
    private $dest;

    /**
     * @var object
     */
    private $source;

    /**
     * @test
     */
    public function hydrate(): void
    {
        ViewModelHydrator::hydrate($this->dest, $this->source, ['field8']);
        Assert::assertObjectsEquals(
            (object) [
                'field1' => 1,
                'field2' => null,
                'field3' => null,
                'field4' => 4,
                'field5' => true,
                'field7' => null,
                'field8' => null,
            ],
            $this->dest
        );
    }

    protected function setUp(): void
    {
        $this->dest = new class {
            public $field1;

            public $field2;

            public $field3;

            public $field4;

            public $field5;

            private $field6;

            public $field7;

            public $field8;
        };

        $this->source = new class {
            public $field1 = 1;

            private $field2 = 2;

            private $field4 = 4;

            private $field5 = true;

            public $field6 = 7;

            public $field8;

            public function getField4(): int
            {
                return $this->field4;
            }

            public function isField5(): bool
            {
                return $this->field5;
            }
        };
    }
}
