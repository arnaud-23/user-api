<?php

declare(strict_types=1);

namespace App\Controller\Api\User;

use App\BusinessRules\User\Requestors\CreateUserRequest;
use App\BusinessRules\User\Responders\UserResponse;
use App\BusinessRules\User\UseCases\CreateUser;
use App\Controller\Api\ResponseTrait;
use App\Controller\Api\ValidationRequestControllerTrait;
use App\Model\User\PostUserModel;
use App\ViewModels\User\UserViewModel;
use App\ViewModels\ViewModelAssembler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class PostUserController
{
    use ResponseTrait;
    use ValidationRequestControllerTrait;

    private CreateUser $createUser;

    public function __construct(CreateUser $createUser)
    {
        $this->createUser = $createUser;
    }

    /**
     * @Route("/users", methods={"POST"}, defaults={"oauth2_scopes":{"user_creation"}})
     */
    public function __invoke(Request $request): JsonResponse
    {
        $model = $this->validateRequest($request, PostUserModel::class);

        $response = $this->createUser($model);

        $vm = ViewModelAssembler::create(UserViewModel::class, $response);

        return $this->createCreatedResponse($vm);
    }

    private function createUser(object $model): UserResponse
    {
        return $this->createUser->execute(
            CreateUserRequest::create($model->email)
                ->withFirstName($model->firstName)
                ->withLastName($model->lastName)
                ->withPassword($model->password)
        );
    }
}
