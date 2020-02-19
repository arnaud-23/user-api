<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

Trait ResponseTrait
{
    private function createCreatedResponse(): JsonResponse
    {
        return new JsonResponse(null, Response::HTTP_CREATED);
    }

    private function createOKResponse(): JsonResponse
    {
        return new JsonResponse(null, Response::HTTP_OK);
    }
}
