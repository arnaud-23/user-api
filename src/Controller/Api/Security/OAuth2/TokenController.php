<?php

declare(strict_types=1);

namespace App\Controller\Api\Security\OAuth2;

use App\Framework\Component\ApiError\ErrorBodyFactory;
use App\Framework\Component\ApiError\ErrorsBody;
use App\Framework\HttpFoundation\RequestFormat;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Exception\OAuthServerException;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

final class TokenController
{
    private AuthorizationServer $server;

    private ErrorBodyFactory $errorBodyFactory;

    private ResponseFactoryInterface $responseFactory;

    private PsrHttpFactory $httpMessageFactory;

    public function __construct(
        AuthorizationServer $server,
        ErrorBodyFactory $errorBodyFactory,
        ResponseFactoryInterface $responseFactory,
        PsrHttpFactory $httpMessageFactory
    ) {
        $this->server = $server;
        $this->errorBodyFactory = $errorBodyFactory;
        $this->responseFactory = $responseFactory;
        $this->httpMessageFactory = $httpMessageFactory;
    }

    /** @Route("/oauth2/token", name="oauth2_token", methods= {"POST"}) */
    public function __invoke(Request $request): ResponseInterface
    {
        $serverResponse = $this->responseFactory->createResponse();

        try {
            $serverRequest = $this->adaptRequest($request);

            return $this->server->respondToAccessTokenRequest($serverRequest, $serverResponse);
        } catch (OAuthServerException $e) {
            $response = $e->generateHttpResponse($serverResponse);

            return $this->adaptExceptionResponse($e, $response);
        }
    }

    private function adaptRequest(Request $request): ServerRequestInterface
    {
        $requestFormat = $request->getContentType();

        if (null === $requestFormat) {
            $content = $request->request->all();
        } elseif (RequestFormat::FORM === $requestFormat) {
            parse_str($request->getContent(), $content);
        } elseif (RequestFormat::JSON === $requestFormat) {
            $content = json_decode($request->getContent(), true);
        } else {
            throw new HttpException(Response::HTTP_UNSUPPORTED_MEDIA_TYPE);
        }

        $serverRequest = $this->httpMessageFactory->createRequest($request);

        return $serverRequest->withParsedBody($content);
    }

    private function adaptExceptionResponse(OAuthServerException $e, ResponseInterface $response): ResponseInterface
    {
        $jsonResponse = new JsonResponse(
            $this->createBody($e),
            $response->getStatusCode(),
            $response->getHeaders()
        );

        return $this->httpMessageFactory->createResponse($jsonResponse);
    }

    private function createBody(OAuthServerException $e): ErrorsBody
    {
        return $this->errorBodyFactory->createSingleError(
            strtoupper($e->getErrorType()),
            null,
            "{$e->getMessage()} {$e->getHint()}."
        );
    }
}
