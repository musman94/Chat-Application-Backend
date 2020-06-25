<?php 

namespace App\Test\TestCase\User\Action;

use App\Test\AppTestTrait;
use App\Action\Action;
use App\Domain\User\Data\UserData;
use App\Domain\User\Service\UserService;
use PHPUnit\Framework\TestCase;

class CreateUserActionTest extends TestCase {
    use AppTestTrait;
    
    public function testCreateUserAction() {
        $userID = 1;
        $username = "testUser";

        $user = new UserData($userID, $username);

        $expected = [
            "statusCode" => 200,
            "data" => [
                "id" => 1,
                "username" => "testUser"
            ]
        ];

        $this->mock(UserService::class)->method('createMessage')->willReturn($user);

        $request = $this->createJsonRequest(
            'POST',
            '/users/addUser',
            ['username' => "testUser"]
        );

        $response = $this->app->handle($request);

        $this->assertJsonData($response, $expected);

    }
}
