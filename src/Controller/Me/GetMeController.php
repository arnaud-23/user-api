<?php

declare(strict_types=1);

namespace App\Controller\Me;

use App\BusinessRules\User\Requestors\GetUserRequestBuilder;
use App\BusinessRules\User\Responders\UserResponse;
use App\BusinessRules\User\UseCases\GetUser;
use App\Controller\ResponseTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class GetMeController extends AbstractController
{
    use ResponseTrait;

    private GetUser $getUser;

    private GetUserRequestBuilder $getUserRequestBuilder;

    public function __construct(GetUser $getUser, GetUserRequestBuilder $getUserRequestBuilder)
    {
        $this->getUser = $getUser;
        $this->getUserRequestBuilder = $getUserRequestBuilder;
    }

    /**
     * @Route("/api/me", methods={"GET"})
     */
    public function getAction(): JsonResponse
    {
        $response = $this->getUserUseCase();

        return $this->createOKResponse();
    }

    private function getUserUseCase(): UserResponse
    {
        return $this->getUser->execute(
            $this->getUserRequestBuilder
                ->create()
                ->withUserId($this->getUser()->getId())
                ->build()
        );
    }
}
