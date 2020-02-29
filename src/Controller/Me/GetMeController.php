<?php

declare(strict_types=1);

namespace App\Controller\Me;

use App\Controller\ResponseTrait;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class GetMeController
{
    use ResponseTrait;

    /**
     * @Route("/api/me", methods={"GET"})
     */
    public function get(): JsonResponse
    {
        return $this->createOKResponse();
    }
}
