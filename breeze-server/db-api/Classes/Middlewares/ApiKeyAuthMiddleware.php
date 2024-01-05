<?php

namespace API\Database\Classes\Middlewares;

use API\Database\Utils\Constants;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Exception\HttpForbiddenException;
use Slim\Exception\HttpUnauthorizedException;

final class ApiKeyAuthMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $apiKey = $request->getHeaderLine('X-API-Key');

        if (!$apiKey) {
            throw new HttpUnauthorizedException($request, 'ERROR_401_API_KEY_MISSING');
        }

        if (!in_array($apiKey, Constants::API_KEYS)) {
            throw new HttpForbiddenException($request, 'ERROR_403_API_KEY_MISSING_OR_WRONG');
        }

        return $handler->handle($request);
    }
}
