<?php

declare(strict_types=1);

namespace App\BusinessRules;

use App\BusinessRules\User\Entities\User;
use App\BusinessRules\User\Responders\UserResponse;
use App\BusinessRules\User\UseCases\DTO\Response\UserResponseDTO;

final class UseCaseResponseAssembler
{
    public static function create(string $responseClassName, $entity): UseCaseResponse
    {
        $response = new $responseClassName();
        DtoFieldsHydrator::hydrate($response, $entity);

        return $response;
    }
}
