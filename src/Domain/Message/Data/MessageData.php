<?php

namespace App\Domain\Message\Data;

use JsonSerializable;

class MessageData implements JsonSerializable {
    /**
     * @var string
     */
    private $from;

    /**
     * @var string
     */
    private $to;

    /**
     * @var string
     */
    private $body;

    /**
     * @param string  $from
     * @param string  $to
     * @param string  $body
     */
    public function __construct(string $from, string $to, string $body) {
        $this->id = $id;
        $this->from = $from;
        $this->to = $to;
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getFrom(): string {
        return $this->from;
    }

    /**
     * @return string
     */
    public function getTo(): string {
        return $this->to;
    }

    /**
     * @return string
     */
    public function getBody(): string {
        return $this->body;
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        return [
            'from' => $this->from,
            'to' => $this->to,
            'body' => $this->body
        ];
    }
}
