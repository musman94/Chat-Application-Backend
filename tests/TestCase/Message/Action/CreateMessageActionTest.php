<?php 

namespace App\Test\TestCase\Message\Action;

use App\Test\AppTestTrait;
use App\Action\Action;
use App\Action\Message\CreateMessageAction;
use App\Domain\Message\Data\MessageData;
use App\Domain\Message\Service\MessageService;
use PHPUnit\Framework\TestCase;

class CreateMessageActionTest extends TestCase {
    use AppTestTrait;
    
    public function testCreateMessageAction() {
        $from = 1;
        $to = 2;
        $body = "testMessage";

        $message = new MessageData($from, $to, $body);

        $expectedResponse = [
            "statusCode" => 200,
            "data" => [
                "from" => 1,
                "to" => 2,
                "body" => "testMessage"
            ]
        ];

        $this->mock(MessageService::class)->method('createMessage')->willReturn($message);

        $this->mock(CreateMessageAction::class)->method('respondWithData')->willReturn($expected);

        $request = $this->createJsonRequest(
            'POST',
            '/messages/sendMessage',
            ["from" => 1, "to" => 2, "body" => "testMessage"]
        );

        $response = $this->app->handle($request);

        $this->assertJsonData($response, $expectedResponse);
    }
}
