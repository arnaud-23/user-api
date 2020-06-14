<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\BusinessRules\User\Requestors\GetUserRequest;
use App\BusinessRules\User\Responders\UserResponse;
use App\BusinessRules\User\UseCases\GetUser;
use App\Controller\ResponseTrait;
use App\ViewModels\User\UserViewModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class GetMeController extends AbstractController
{
    use ResponseTrait;

    private GetUser $getUser;

    public function __construct(GetUser $getUser)
    {
        $this->getUser = $getUser;
    }

    /**
     * @Route("/api/me", methods={"GET"})
     */
    public function getAction(): JsonResponse
    {

        $response = $this->getUserUseCase();

        $vm = UserViewModel::create($response);

        return $this->createOKResponse($vm);
    }

    private function getUserUseCase(): UserResponse
    {
        return $this->getUser->execute(
            GetUserRequest::create()
                ->withUserId($this->getUser()->getId())
        );
    }
}
