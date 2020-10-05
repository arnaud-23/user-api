<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Framework\Component\ApiError\ApiExceptionFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

trait ValidationRequestControllerTrait
{
    private ValidatorInterface $validator;

    private ApiExceptionFactory $apiExceptionFactory;

    /** @required */
    final public function setValidator(ValidatorInterface $validator): void
    {
        $this->validator = $validator;
    }

    /** @required */
    final public function setApiExceptionFactory(ApiExceptionFactory $apiExceptionFactory): void
    {
        $this->apiExceptionFactory = $apiExceptionFactory;
    }

    /** @return array|object */
    private function validateRequest(Request $request, string $model)
    {
        $model = $this->serializer->deserialize($request->getContent(), $model, 'json');
        $violations = $this->validator->validate($model);

        if ($violations->count() > 0) {
            throw $this->apiExceptionFactory->createFromViolations($violations);
        }

        return $model;
    }
}
