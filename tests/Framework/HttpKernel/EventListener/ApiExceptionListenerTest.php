<?php

declare(strict_types=1);

namespace App\Framework\HttpKernel\EventListener;

use App\Framework\Component\ApiError\ErrorBodyFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

final class ApiExceptionListenerTest extends TestCase
{
    private const REQUEST_URI = 'http://' . self::API_HOST_TEST;

    private const API_HOST_TEST = 'api.example.test';

    private ApiExceptionListener $listener;

    /** @test */
    public function exceptionNotSupportedDoNothing(): void
    {
        $event = $this->createEvent(Request::create(''), new \Exception());

        $this->listener->onException($event);

        $this->assertTrue(true);
    }

    private function createEvent(Request $request, \Exception $exception): ExceptionEvent
    {
        $kernel = $this->createMock(HttpKernelInterface::class);

        return new ExceptionEvent($kernel, $request, HttpKernelInterface::MASTER_REQUEST, $exception);
    }

    /** @test */
    public function NotFoundHttpExceptionReturnResponse(): void
    {
        $event = $this->createEvent(
            Request::create(self::REQUEST_URI),
            new NotFoundHttpException('No route found message')
        );

        $this->listener->onException($event);

        $this->assertEquals(Response::HTTP_NOT_FOUND, $event->getResponse()->getStatusCode());
        $this->assertEquals('{"errors":[{"message":"No route found message"}]}', $event->getResponse()->getContent());
    }

    /** @test */
    public function badRequestHttpExceptionReturnResponse(): void
    {
        $event = $this->createEvent(
            Request::create(self::REQUEST_URI),
            new BadRequestHttpException('{"errors":[{"message":"Bad request message"}]}')
        );

        $this->listener->onException($event);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $event->getResponse()->getStatusCode());
        $this->assertEquals('{"errors":[{"message":"Bad request message"}]}', $event->getResponse()->getContent());
    }

    /** @test */
    public function httpUnauthorizedExceptionReturnResponse(): void
    {
        $event = $this->createEvent(
            Request::create(self::REQUEST_URI),
            new AuthenticationException('Unauthorized message')
        );

        $this->listener->onException($event);

        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $event->getResponse()->getStatusCode());
        $this->assertEquals('{"errors":[{"message":"Unauthorized message"}]}', $event->getResponse()->getContent());
    }

    protected function setUp(): void
    {
        $this->listener = new ApiExceptionListener(self::API_HOST_TEST, new ErrorBodyFactory());
    }
}
