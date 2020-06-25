<?php

namespace App\Action\Message;

use App\Action\Message\MessageAction;
use Psr\Http\Message\ResponseInterface;

class CreateMessageAction extends MessageAction {
    /**
     * {@inheritdoc}
     */
    protected function action(): ResponseInterface {
        $data = (array)$this->request->getParsedBody();

        $message = $this->messageService->createMessage($data);
        
        return $this->respondWithData($message);

    }
}