<?php

declare(strict_types=1);

namespace App\Controller;

use App\Framework\HttpFoundation\Header;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

trait ResponseTrait
{
    private SerializerInterface $serializer;

    /**
     * @Required
     */
    public function setSerializer(SerializerInterface $serializer): void
    {
        $this->serializer = $serializer;
    }

    private function createCreatedResponse(string $locationUrl = null, $vm = null): JsonResponse
    {
        $headers = null !== $locationUrl ? [Header::LOCATION => $locationUrl] : [];

        return $this->createJsonResponse($vm ?? new \stdClass(), Response::HTTP_CREATED, $headers);
    }

    protected function createJsonResponse($vm, int $status = Response::HTTP_OK, array $headers = []): JsonResponse
    {
        return new JsonResponse($this->serialize($vm), $status, $headers, true);
    }

    private function serialize($vm): string
    {
        return $this->serializer->serialize($vm, 'json');
    }

    private function createOKResponse($vm): JsonResponse
    {
        return $this->createJsonResponse($vm, Response::HTTP_OK);
    }
}
