<?php

declare(strict_types=1);

namespace App\Controller\Api\User;

use App\BusinessRules\User\Requestors\GetUserRequest;
use App\BusinessRules\User\Responders\UserResponse;
use App\BusinessRules\User\UseCases\GetUser;
use App\Controller\Api\ResponseTrait;
use App\ViewModels\User\UserViewModel;
use App\ViewModels\ViewModelAssembler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class GetMeController
{
    use ResponseTrait;

    private GetUser $getUser;

    public function __construct(GetUser $getUser)
    {
        $this->getUser = $getUser;
    }

    /**
     * @Route("/me", methods={"GET"}, defaults={"oauth2_scopes":{"user_basic_profile"}})
     * @IsGranted("ROLE_USER")
     */
    public function getAction(): JsonResponse
    {
        $response = $this->getUserUseCase();

        return $this->createOKResponse(ViewModelAssembler::create(UserViewModel::class, $response));
    }

    private function getUserUseCase(): UserResponse
    {
        return $this->getUser->execute(GetUserRequest::create()->withUserId($this->getUser()->getId()));
    }
}
