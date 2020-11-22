<?php

namespace App\Framework\Component\ApiError;

use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final class ErrorBodyFactory
{
    public function createSingleError(
        string $code = null,
        string $field = null,
        string $message = null,
        string $value = null
    ): ErrorsBody {
        $error = $this->create($code, $field, $message, $value);

        return new ErrorsBody([$error]);
    }

    private function create(
        string $code = null,
        string $field = null,
        string $message = null,
        string $value = null
    ): ErrorBody {
        return new ErrorBody($code, $field, $message, $value);
    }

    public function createFromViolations(ConstraintViolationListInterface $violations): ErrorsBody
    {
        $errors = [];
        foreach ($violations as $violation) {
            $errors[] = $this->createFromViolation($violation);
        }

        return new ErrorsBody($errors);
    }

    private function createFromViolation(ConstraintViolation $violation): ErrorBody
    {
        if (empty($violation->getPropertyPath())) {
            return $this->create(
                $violation->getConstraint()::getErrorName($violation->getCode()),
                null,
                $violation->getMessage(),
                null
            );
        } else {
            return $this->create(
                $violation->getConstraint()::getErrorName($violation->getCode()),
                $violation->getPropertyPath(),
                $violation->getMessage(),
                $violation->getInvalidValue()
            );
        }
    }
}
