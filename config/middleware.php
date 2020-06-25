<?php

use Slim\App;
use Slim\Middleware\ErrorMiddleware;
use Selective\BasePath\BasePathMiddleware;
use App\Middleware\HttpExceptionMiddleWare;

return function (App $app) {
    $app->addBodyParsingMiddleware();

    $app->addRoutingMiddleware();

    $app->add(BasePathMiddleware::class);

    $app->add(HttpExceptionMiddleWare::class); 

    $app->add(ErrorMiddleware::class);

    /*
    $app->add(new Tuupola\Middleware\HttpBasicAuthentication([
        "users" => [
            "testUser" => "testPass"
        ]
    ]));
    */
};

