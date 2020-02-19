<?php

declare(strict_types=1);

namespace App\Controller;

use App\Framework\Component\ApiError\ApiExceptionFactory;
use Doctrine\Common\Annotations\Annotation\Required;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

trait ValidationRequestControllerTrait
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var ApiExceptionFactory
     */
    private $apiExceptionFactory;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @Required
     */
    public function setValidator(ValidatorInterface $validator): void
    {
        $this->validator = $validator;
    }

    /**
     * @Required
     */
    public function setApiExceptionFactory(ApiExceptionFactory $apiExceptionFactory): void
    {
        $this->apiExceptionFactory = $apiExceptionFactory;
    }

    /**
     * @Required
     */
    public function setSerializer(SerializerInterface $serializer): void
    {
        $this->serializer = $serializer;
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
}
