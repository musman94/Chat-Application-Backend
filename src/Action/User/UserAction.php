<?php

namespace App\Action\User;

use App\Action\Action;
use App\Domain\User\Service\UserService;

abstract class UserAction extends Action {
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService) {
        $this->userService = $userService;
    } 
}
