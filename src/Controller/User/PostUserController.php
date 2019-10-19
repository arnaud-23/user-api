<?php

namespace App\Controller\User;

use App\BusinessRules\User\Requestors\CreateUserRequestBuilder;
use App\BusinessRules\User\UseCases\CreateUser;
use App\Framework\Component\ApiError\ApiExceptionFactory;
use App\Model\User\PostUserModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostUserController
{
    const JSON = 'json';

    /**
     * @var CreateUser
     */
    private $createUser;

    /**
     * @var CreateUserRequestBuilder
     */
    private $createUserRequestBuilder;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var ApiExceptionFactory
     */
    private $apiExceptionFactory;

    public function __construct(
        CreateUser $createUser,
        CreateUserRequestBuilder $createUserRequestBuilder,
        ValidatorInterface $validator,
        ApiExceptionFactory $apiExceptionFactory
    ) {
        $this->createUser = $createUser;
        $this->createUserRequestBuilder = $createUserRequestBuilder;
        $this->validator = $validator;
        $this->apiExceptionFactory = $apiExceptionFactory;
    }

    /**
     * @Route("/api/users", methods={"POST"})
     */
    public function post(Request $request): JsonResponse
    {
        $model = new PostUserModel($request->getContent());
        $violations = $this->validator->validate($model);
        if ($violations->count() > 0) {
            throw $this->apiExceptionFactory->createFromViolations($violations);
        }

        $this->createUser->execute(
            $this->createUserRequestBuilder
                ->create($model->email)
                ->withFirstName($model->firstName)
                ->withLastName($model->lastName)
                ->build()
        );

        return $this->createCreatedResponse();
    }

    private function createCreatedResponse(): JsonResponse
    {
        return new JsonResponse('', Response::HTTP_CREATED);
    }
}