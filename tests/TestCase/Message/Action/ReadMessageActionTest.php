<?php 

namespace App\Test\TestCase\Message\Action;

use App\Test\AppTestTrait;
use App\Action\Action;
use App\Domain\Message\Data\MessageData;
use App\Domain\Message\Service\MessageService;
use PHPUnit\Framework\TestCase;

class ReadMessageActionTest extends TestCase {
    use AppTestTrait;
    
    public function testReadAllMessagesAction() {
        $messageOne = new MessageData(1, 2, "testMessageOne");
        $messageTwo = new MessageData(3, 2, "testMessageTwo");

        $messagesArray = array($messageOne, $messageTwo); 

        $expectedResponse = [
            [
                "statusCode" => 200,
                "data" => [
                "from" => 1,
                "to" => 2,
                "body" => "testMessageOne"
                ]
            ],
            [
                "statusCode" => 200,
                "data" => [
                "from" => 3,
                "to" => 2,
                "body" => "testMessageTwo"
                ]
            ]    
        ];

        $this->mock(MessageService::class)->method('readMessages')->willReturn($messagesArray);

        $this->mock(MessageService::class)->method('respondWithData')->willReturn($expectedResponse);

        $request = $this->createJsonRequest(
            'POST',
            '/messages/sendMessage',
            ["from" => 1, "to" => 2, "body" => "testMessage"]
        );

        $response = $this->app->handle($request);

        $this->assertJsonData($response, $expectedResponse);
    }
}
