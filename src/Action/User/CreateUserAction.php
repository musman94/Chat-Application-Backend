<?php

namespace App\Action\User;

use App\Action\User\UserAction;
use Psr\Http\Message\ResponseInterface;

class CreateUserAction extends UserAction {   
    /**
     * {@inheritdoc}
     */
    protected function action(): ResponseInterface {
        $data = (array)$this->request->getParsedBody();

        $user = $this->userService->createUser($data);
        
        return $this->respondWithData($user);
    }
}
