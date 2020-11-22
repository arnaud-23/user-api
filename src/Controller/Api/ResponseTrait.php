<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Framework\HttpFoundation\Header;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ResponseTrait
{
    use SerializerTrait;

    private function createCreatedResponse($vm = null, string $locationUrl = null): JsonResponse
    {
        $headers = null !== $locationUrl ? [Header::LOCATION => $locationUrl] : [];

        return $this->createJsonResponse($vm ?? new \stdClass(), Response::HTTP_CREATED, $headers);
    }

    private function createJsonResponse($vm, int $status = Response::HTTP_OK, array $headers = []): JsonResponse
    {
        return new JsonResponse($this->serialize($vm), $status, $headers, true);
    }

    private function createOKResponse($vm): JsonResponse
    {
        return $this->createJsonResponse($vm, Response::HTTP_OK);
    }
}
