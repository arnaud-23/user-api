<?php

namespace App\Framework\Component\ApiError;

use App\Doubles\Model\ModelStub;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;

final class ApiExceptionFactoryTest extends TestCase
{
    private ApiExceptionFactory $factory;

    /** @test */
    public function createWithMessageNullReturnException(): void
    {
        $actual = $this->factory->create(Response::HTTP_I_AM_A_TEAPOT);

        $this->assertSame(Response::HTTP_I_AM_A_TEAPOT, $actual->getStatusCode());
        $this->assertSame('', $actual->getMessage());
        $this->assertSame('{}', json_encode($actual));
    }

    /** @test */
    public function createReturnException(): void
    {
        $actual = $this->factory->create(Response::HTTP_I_AM_A_TEAPOT, 'message', 'code');
        $this->assertEquals(Response::HTTP_I_AM_A_TEAPOT, $actual->getStatusCode());
        $this->assertEquals('{"errors":[{"code":"code","message":"message"}]}', $actual->getMessage());
    }

    /** @test */
    public function createFromEmptyViolationsReturnException(): void
    {
        $actual = $this->factory->createFromViolations(new ConstraintViolationList());
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $actual->getStatusCode());
        $this->assertEquals('', $actual->getMessage());
        $this->assertSame('{}', json_encode($actual));
    }

    /** @test */
    public function createFromViolationsReturnException(): void
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

        $response = $this->factory->createFromViolations(
            new ConstraintViolationList(
                [
                    $violationWithoutProperty,
                    $violationWithProperty,
                ]
            )
        );
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertEquals(
            '{"errors":[{"code":"IS_BLANK_ERROR","message":"This value should not be blank."},{"code":"IS_BLANK_ERROR","field":"field","message":"This value should not be blank."}]}',
            $response->getMessage()
        );
    }

    protected function setUp(): void
    {
        $this->factory = new ApiExceptionFactory(new ErrorBodyFactory());
    }
}
