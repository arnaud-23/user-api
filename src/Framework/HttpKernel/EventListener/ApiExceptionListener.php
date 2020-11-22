<?php

declare(strict_types=1);

namespace App\Framework\HttpKernel\EventListener;

use App\Framework\Component\ApiError\ErrorBodyFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

final class ApiExceptionListener
{
    private string $apiHost;

    private ErrorBodyFactory $errorBodyFactory;

    public function __construct(string $apiHost, ErrorBodyFactory $errorBodyFactory)
    {
        $this->apiHost = $apiHost;
        $this->errorBodyFactory = $errorBodyFactory;
    }

    public function onException(ExceptionEvent $event): void
    {
        if (!$this->supportsException($event)) {
            return;
        }

        $exception = $event->getThrowable();

        if ($exception instanceof HttpException) {
            $this->handleHttpException($exception, $event);
        }

        if ($exception instanceof AuthenticationException) {
            $this->handleAuthenticationException($exception, $event);
        }
    }

    private function supportsException(ExceptionEvent $event): bool
    {
        return $event->getRequest()->getHost() === $this->apiHost;
    }

    private function handleHttpException(HttpException $exception, ExceptionEvent $event): void
    {
        $message = $exception->getMessage();
        if ($exception instanceof NotFoundHttpException) {
            $message = json_encode($this->errorBodyFactory->createSingleError(null, null, $exception->getMessage()));
        }

        $event->setResponse(new JsonResponse($message, $exception->getStatusCode(), $exception->getHeaders(), true));
    }

    private function handleAuthenticationException(AuthenticationException $exception, ExceptionEvent $event): void
    {
        $message = $this->errorBodyFactory->createSingleError(null, null, $exception->getMessage());

        $event->setResponse(new JsonResponse($message, Response::HTTP_UNAUTHORIZED, []));
    }
}
