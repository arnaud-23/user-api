<?php

declare(strict_types=1);

namespace App\BusinessRules;

final class UseCaseResponseAssembler
{
    public static function create(string $responseClassName, $entity): UseCaseResponse
    {
        $response = new $responseClassName();
        UseCaseResponseHydrator::hydrate($response, $entity);

        return $response;
    }
}
