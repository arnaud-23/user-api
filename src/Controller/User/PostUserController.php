<?php

namespace App\Controller\User;

use App\BusinessRules\UseCase;
use App\BusinessRules\User\Requestors\CreateUserRequestBuilder;
use App\BusinessRules\User\UseCases\CreateUser;
use App\Controller\ResponseTrait;
use App\Controller\ValidationRequestControllerTrait;
use App\Model\User\PostUserModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostUserController
{
    use ResponseTrait;
    use ValidationRequestControllerTrait;

    /**
     * @var CreateUser
     */
    private $createUser;

    /**
     * @var CreateUserRequestBuilder
     */
    private $createUserRequestBuilder;

    public function __construct(
        UseCase $createUser,
        CreateUserRequestBuilder $createUserRequestBuilder
    ) {
        $this->createUser = $createUser;
        $this->createUserRequestBuilder = $createUserRequestBuilder;
    }

    /**
     * @Route("/api/users", methods={"POST"}, defaults={"oauth2_scopes":{"user_creation"}})
     */
    public function post(Request $request): JsonResponse
    {
        $model = $this->validateRequest($request, PostUserModel::class);

        $this->createUser->execute(
            $this->createUserRequestBuilder
                ->create($model->email)
                ->withFirstName($model->firstName)
                ->withLastName($model->lastName)
                ->withPassword($model->password)
                ->build()
        );

        return $this->createCreatedResponse();
    }
}
