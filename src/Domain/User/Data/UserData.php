<?php

namespace App\Domain\User\Data;

use JsonSerializable;

class UserData implements JsonSerializable {
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @param int  $id
     * @param string $username
     */
    public function __construct(int $id, string $username) {
        $this->id = $id;
        $this->username = strtolower($username);
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string {
        return $this->username;
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'username' => $this->username
        ];
    }
}
