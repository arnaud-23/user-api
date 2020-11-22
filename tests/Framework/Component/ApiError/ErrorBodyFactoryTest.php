<?php

namespace App\Framework\Component\ApiError;

use App\Doubles\Model\ModelStub;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationList;

final class ErrorBodyFactoryTest extends TestCase
{
    private ErrorBodyFactory $factory;

    public function singleErrorProvider(): \Generator
    {
        $nullData = ['code' => null, 'field' => null, 'message' => null, 'value' => null];
        $nullResult = 'null';

        $partialData = ['code' => 'code', 'field' => null, 'message' => 'lorem ipsum', 'value' => null];
        $partialResult = '{"errors": [{"code":"code","message":"lorem ipsum"}]}';

        $fullData = ['code' => 'code', 'field' => 'field', 'message' => 'lorem ipsum', 'value' => 5];
        $fullResult = '{"errors": [{"code":"code","field":"field","message":"lorem ipsum","value":"5"}]}';

        yield [$nullData, $nullResult];
        yield [$partialData, $partialResult];
        yield [$fullData, $fullResult];
    }

    /**
     * @test
     * @dataProvider singleErrorProvider
     */
    public function createSingleError(array $data, string $result): void
    {
        $errors = $this->factory->createSingleError($data['code'], $data['field'], $data['message'], $data['value']);

        Assert::assertJsonStringEqualsJsonString($result, json_encode($errors));
    }

    public function violationErrorProvider(): \Generator
    {
        $model = new ModelStub();

        $constraint = new NotBlank();
        $violationWithProperty = new ConstraintViolation(
            $constraint->message,
            null,
            [],
            $model,
            'field',
            $model->field,
            null,
            $constraint::IS_BLANK_ERROR,
            $constraint
        );
        $resultWithProperty = '{"errors": [{"code":"IS_BLANK_ERROR","field":"field","message":"This value should not be blank."}]}';

        $violationWithoutProperty = new ConstraintViolation(
            $constraint->message,
            null,
            [],
            $model,
            null,
            $model->field,
            null,
            $constraint::IS_BLANK_ERROR,
            $constraint
        );
        $resultWithoutProperty = '{"errors": [{"code":"IS_BLANK_ERROR","message":"This value should not be blank."}]}';

        yield [$violationWithProperty, $resultWithProperty];
        yield [$violationWithoutProperty, $resultWithoutProperty];
    }

    /**
     * @test
     * @dataProvider violationErrorProvider
     */
    public function createFromViolations(ConstraintViolationInterface $violation, string $result): void
    {
        $violations = new ConstraintViolationList([$violation]);

        $errors = $this->factory->createFromViolations($violations);

        Assert::assertJsonStringEqualsJsonString($result, json_encode($errors));
    }

    protected function setUp(): void
    {
        $this->factory = new ErrorBodyFactory();
    }
}
