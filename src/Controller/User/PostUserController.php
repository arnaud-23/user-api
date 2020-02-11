<?php

namespace App\Controller\User;

use App\BusinessRules\UseCase;
use App\BusinessRules\User\Requestors\CreateUserRequestBuilder;
use App\BusinessRules\User\UseCases\CreateUser;
use App\Framework\Component\ApiError\ApiExceptionFactory;
use App\Model\User\PostUserModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
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

    /** @var Serializer */
    private $serializer;

    public function __construct(
        UseCase $createUser,
        CreateUserRequestBuilder $createUserRequestBuilder,
        ValidatorInterface $validator,
        ApiExceptionFactory $apiExceptionFactory,
        Serializer $serializer
    ) {
        $this->createUser = $createUser;
        $this->createUserRequestBuilder = $createUserRequestBuilder;
        $this->validator = $validator;
        $this->apiExceptionFactory = $apiExceptionFactory;
        $this->serializer = $serializer;
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

    /**
     * @return array|object
     */
    private function validateRequest(Request $request, string $model)
    {
        $model = $this->serializer->deserialize($request->getContent(), $model, 'json');
        $violations = $this->validator->validate($model);

        if ($violations->count() > 0) {
            throw $this->apiExceptionFactory->createFromViolations($violations);
        }

        return $model;
    }

    private function createCreatedResponse(): JsonResponse
    {
        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
