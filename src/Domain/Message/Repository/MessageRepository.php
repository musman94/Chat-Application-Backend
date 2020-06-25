<?php

namespace App\Domain\Message\Repository;

use PDO;
use Exception;

class MessageRepository {
     /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * Constructor.
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

     /**
     * Insert new Message
     * @param string $from
     * @param string $to
     * @param string $body
     * @return int
     */
    public function insertMessage(string $from, string $to, string $body): int {
        $query = "INSERT into messages ('from', 'to', body) VALUES (:from, :to, :body)";

        try {
            $statement = $this->connection->prepare($query);
            $statement -> bindParam(':from', $from);
            $statement -> bindParam(':to', $to);
            $statement -> bindParam(':body', $body);
            $statement -> execute();

            return (int)$this->connection->lastInsertId();
            
        } catch(\PDOException $e) {
		    throw new Exception("Either one or both of the users do not exist", 500);
        }
    }

    /**
     * Fetch all of the messages sent to the user 
     * @param string $to
     * @return array 
     */
    public function readMessages(string $to): array {  
        $query = "SELECT m.'from', m.'to', m.body, m.time_stamp
				  FROM messages m
				  WHERE m.'to' = :to
				  ORDER BY m.time_stamp";

        try {
            $statement = $this->connection->prepare($query);
            $statement -> bindParam(':to', $to);
            $statement -> execute();
            
            $rows = $statement -> fetchAll(\PDO::FETCH_ASSOC);
            
            return $rows;

        } catch(\PDOException $e) {
            throw new Exception("The user doesnot exist", 500);
        }
    }
}