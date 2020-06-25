<?php 

namespace App\Domain\Message\Service;

use Exception;
use App\Domain\Message\Data\MessageData;
use App\Domain\Message\Repository\MessageRepository;

/**
 * MessageService.
 */
class MessageService {
    /**
     * @var MessageRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param MessageRepository $repository 
     */
    public function __construct(MessageRepository $repository) {
        $this->repository = $repository;
    }

     /**
     * Create a new message.
     * @param array $data The request data
     * @return int The new message ID
     * @throws Exception
     */
    public function createMessage(array $data): MessageData {
        $from = $this->resolveParam($data, "from");
        $to = $this->resolveParam($data, "to");
        $body = $this->resolveParam($data, "body");

        $messageID = $this->repository->insertMessage($from, $to, $body);

        $message = $this->makeMessageResponseObject($from, $to, $body);

        return $message;
    }

    /**
     * Returns all of the messages sent to the user.
     * @param array $data The request data
     * @return array $messages
     */
    public function readMessages(array $data): array {
        $to = $this->resolveParam($data, "to");
        
        $messages = $this->repository->readMessages($to);
        $messagesList = array();

        foreach($messages as $message) {
            $from = $message["from"];
            $to = $message["to"];
            $body = $message["body"];

            $messageObject = $this->makeMessageResponseObject($from, $to, $body);
            array_push($messagesList, $messageObject);
        }

        return $messagesList;
    }

    /**
    * @param  string $name
    * @return mixed
    * @throws Exception
    */
    private function resolveParam(array $data, string $name) {
        if (empty($data[$name])) {
            throw new Exception("Could not resolve parameter `{$name}`. Please check your input", 400);
        }

        return $data[$name];
    }

    /**
     * @param string $from
     * @param string $to
     * @param string $body
     * @return MessageData
     */
    private function makeMessageResponseObject(string $from, string $to, string $body): MessageData {
        return new MessageData($from, $to, $body);
    }

}