<?php

namespace App\Action;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpException;

abstract class Action {
    /**
     * @var HttpErrorHandler
     */
    protected $errorHandler;

    /**
     * @var ServerRequestInterface
     */
    protected $request;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @var array
     */
    protected $args;

    /**
     * @param Constructor 
     */
    public function __construct(HttpErrorHandler $errorHandler) {
        $this->errorHandler = $errorHandler;
    }

    /**
     * @param ServerRequestInterface  $request
     * @param ResponseInterface $response
     * @param array args
     * @throws Exception
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
        
        try {
            return $this->action();
        } catch (Exception $e) {
            throw new HttpException($this->request, $e->getMessage(), $e->getCode());
        }
    }

    /**
     * @return ResponseInterface
     * @throws Exception
     */
    abstract protected function action(): ResponseInterface;

    /**
     * @param  array|object|null $data
     * @return ResponseInterface
     */
    protected function respondWithData($data = null, int $statusCode = 200): ResponseInterface {
        $payload = new ActionPayload($statusCode, $data);

        return $this->respond($payload);
    }
    
    /**
     * @param ActionPayload $payload
     * @return Response
     */
    protected function respond(ActionPayload $payload): ResponseInterface {
        $json = json_encode($payload, JSON_PRETTY_PRINT);
        $this->response->getBody()->write($json);

        return $this->response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus($payload->getStatusCode());
    }

}
