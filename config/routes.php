<?php

use Slim\App;

return function (App $app) {
    $app->post('/users/addUser', \App\Action\User\CreateUserAction::class);
    $app->post('/messages/sendMessage', \App\Action\Message\CreateMessageAction::class);
    $app->get('/messages/getMessages', \App\Action\Message\ReadMessageAction::class);
};