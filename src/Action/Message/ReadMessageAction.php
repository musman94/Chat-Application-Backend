<?php

namespace App\Action\Message;

use App\Action\Message\MessageAction;
use Psr\Http\Message\ResponseInterface;

class ReadMessageAction extends MessageAction {
    /**
     * {@inheritdoc}
     */
    protected function action(): ResponseInterface {
        $data = (array)$this->request->getParsedBody();

        $messages = $this->messageService->readMessages($data);
        
        return $this->respondWithData($messages);

    }
}