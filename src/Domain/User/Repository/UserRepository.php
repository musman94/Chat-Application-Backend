<?php

namespace App\Domain\User\Repository;

use PDO;
use Exception;

/**
 * Repository.
 */
class UserRepository {
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
     * Inserts a new user
     * @param string $username
     * @return int
     * @throws Exception
     */
    public function insertUser(string $username): int {
        $query = 'INSERT INTO users (username) VALUES (:username)';
        
        try {
            $statement = $this->connection->prepare($query);
        
            $statement -> bindParam(':username', $username);
                    
            $statement -> execute();
            
            return (int)$this->connection->lastInsertId();
            
        } catch(\PDOException $e) {
            throw new Exception("There was an error while inserting the user", 500);
		}

    }
}
