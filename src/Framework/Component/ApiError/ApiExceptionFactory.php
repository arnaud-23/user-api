<?php

namespace App\Framework\Component\ApiError;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Throwable;

final class ApiExceptionFactory
{
    private ErrorBodyFactory $errorBodyFactory;

    public function __construct(ErrorBodyFactory $errorBodyFactory)
    {
        $this->errorBodyFactory = $errorBodyFactory;
    }

    public function create(
        int $statusCode,
        string $message = null,
        string $code = null,
        Throwable $previous = null
    ): HttpException {
        $error = $this->errorBodyFactory->createSingleError($code, null, $message, null);

        return new HttpException($statusCode, $error->isEmpty() ? null : json_encode($error), $previous);
    }

    public function createFromViolations(ConstraintViolationListInterface $violations): BadRequestHttpException
    {
        $errors = $this->errorBodyFactory->createFromViolations($violations);

        return new BadRequestHttpException($errors->isEmpty() ? null : json_encode($errors));
    }
}
