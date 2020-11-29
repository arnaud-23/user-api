<?php

declare(strict_types=1);

namespace App\Framework\Component\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
final class AvailableEmail extends Constraint
{
    public const NOT_AVAILABLE_EMAIL = 'NOT_AVAILABLE_EMAIL';

    protected static $errorNames = [
        self::NOT_AVAILABLE_EMAIL => 'NOT_AVAILABLE_EMAIL',
    ];

    public string $message = 'This email is already used.';
}
