<?php

declare(strict_types=1);

namespace App\Controller\Api\User;

use App\BusinessRules\User\Requestors\CreateUserRequest;
use App\BusinessRules\User\UseCases\CreateUser;
use App\Controller\ResponseTrait;
use App\Controller\ValidationRequestControllerTrait;
use App\Model\User\PostUserModel;
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
     * @Route("/api/users", methods={"POST"}, defaults={"oauth2_scopes":{"user_creation"}})
     */
    public function post(Request $request): JsonResponse
    {
        $model = $this->validateRequest($request, PostUserModel::class);

        $this->createUser->execute(
            CreateUserRequest::create($model->email)
                ->withFirstName($model->firstName)
                ->withLastName($model->lastName)
                ->withPassword($model->password)
        );

        return $this->createCreatedResponse();
    }
}
