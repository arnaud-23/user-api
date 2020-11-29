<?php

declare(strict_types=1);

namespace App\Framework\Component\Validator\Constraints;

use App\BusinessRules\User\Gateways\UserGateway;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

final class AvailableEmailValidator extends ConstraintValidator
{
    private UserGateway $userGateway;

    public function __construct(UserGateway $userGateway)
    {
        $this->userGateway = $userGateway;
    }

    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof AvailableEmail) {
            throw new UnexpectedTypeException($constraint, AvailableEmail::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        if ($this->userGateway->emailExist($value)) {
            $this->context->buildViolation($constraint->message)
                ->setCode(AvailableEmail::NOT_AVAILABLE_EMAIL)
                ->addViolation();
        }
    }
}
