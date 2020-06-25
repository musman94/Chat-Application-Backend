<?php

namespace App\Middleware;

use App\Action\ActionError;
use App\Action\ActionPayload;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Exception\HttpException;
use Slim\Psr7\Response;
use Exception;

final class HttpExceptionMiddleware implements MiddlewareInterface {
    public function process(
        ServerRequestInterface $request, 
        RequestHandlerInterface $handler
    ): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (HttpException $httpException) {
            $statusCode = 500;
            $error = new ActionError(
                ActionError::SERVER_ERROR,
                'An internal error has occurred while processing your request.'
            );
            
            $statusCode = $httpException->getCode();
            $error->setDescription($httpException->getMessage());

            if ($statusCode == 404) {
                $error->setType(ActionError::RESOURCE_NOT_FOUND);
            } elseif ($statusCode == 405) {
                $error->setType(ActionError::NOT_ALLOWED);
            } elseif ($statusCode == 401) {
                $error->setType(ActionError::UNAUTHORIZED);
            } elseif ($statusCode == 403) {
                $error->setType(ActionError::INSUFFICIENT_PRIVILEGES);
            } elseif ($statusCode == 400) {
                $error->setType(ActionError::BAD_REQUEST);
            } elseif ($statusCode == 501) {
                $error->setType(ActionError::NOT_IMPLEMENTED);
            }
            
            $payload = new ActionPayload($statusCode, null, $error);
            $encodedPayload = json_encode($payload, JSON_PRETTY_PRINT);

            $response = (new Response())->withStatus($statusCode);
            $response->getBody()->write($encodedPayload);

            return $response->withHeader('Content-Type', 'application/json');
        }
        
    }
}
