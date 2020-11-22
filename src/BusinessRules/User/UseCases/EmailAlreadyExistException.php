<?php

declare(strict_types=1);

namespace App\BusinessRules\User\UseCases;

use App\BusinessRules\BusinessRulesException;

final class EmailAlreadyExistException extends BusinessRulesException
{
}
