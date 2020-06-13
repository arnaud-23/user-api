<?php

namespace App\BusinessRules;

use App\BusinessRules\UseCaseResponseHydrator;
use App\Doubles\Assert;
use App\ViewModels\ViewModelHydrator;
use PHPUnit\Framework\TestCase;

final class UseCaseResponseHydratorTest extends TestCase
{
    /** @var object */
    private $response;

    /** @var object */
    private $entity;

    /** @test */
    public function hydrate(): void
    {
        UseCaseResponseHydrator::hydrate($this->response, $this->entity);
        Assert::assertObjectsEquals(
            (object) [
                'field1' => 1,
                'field2' => null,
                'field3' => null,
                'field4' => 4,
                'field5' => true,
                'field7' => null,
            ],
            $this->response
        );
    }

    protected function setUp(): void
    {
        $this->response = new class {
            public $field1;

            public $field2;

            public $field3;

            public $field4;

            public $field5;

            private $field6;

            public $field7;
        };

        $this->entity = new class {
            public $field1 = 1;

            private $field2 = 2;

            private $field4 = 4;

            private $field5 = true;

            public $field6 = 7;

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
