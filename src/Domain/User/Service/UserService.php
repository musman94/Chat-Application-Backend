<?php

namespace App\Domain\User\Service;

use Exception;
use App\Domain\User\Data\UserData;
use App\Domain\User\Repository\UserRepository;

/**
 * UserService.
 */
class UserService {
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param UserRepository $repository The repository
     */
    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * Create a new user.
     * @param array $data The request data
     * @return int The new user ID
     * @throws Exception
     */
    public function createUser(array $data): UserData {
        $username = $this->resolveParam($data, "username");
        
        $userID = $this->repository->insertUser($username);

        $user = $this->makeUserResponseObject($userID, $username);

        return $user;
    }

     /**
     * @param array $data
     * @return string
     * @throws Exception
     */ 
    private function resolveParam(array $data, string $name) {
        if (empty($data[$name])) {
            throw new Exception("Could not resolve parameter `{$name}`. Please check your input", 400);
        }

        return $data[$name];
    }

    /**
     * @param int $userID
     * @param string $username
     * @return UserData
     */
    private function makeUserResponseObject(int $userID, string $username): UserData {
        return new UserData($userID, $username);
    }

}