<?php 

namespace App\Action\Message;

use App\Action\Action;
use App\Domain\Message\Service\MessageService;

abstract class MessageAction extends Action {
    /**
    * @var MessageService
    */
    protected $messageService;

    /**
     * @param MessageService $messageService
     */
    public function __construct(MessageService $messageService) {
        $this->messageService = $messageService;
    } 
}