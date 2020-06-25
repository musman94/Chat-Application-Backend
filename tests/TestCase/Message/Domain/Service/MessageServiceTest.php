<?php

namespace Test\TestCase\Message\Domain\Service;

use Exception;
use App\Test\AppTestTrait;
use App\Domain\Message\Data\MessageData;
use App\Domain\Message\Repository\MessageRepository;
use App\Domain\Message\Service\MessageService;
use PHPUnit\Framework\TestCase;

/**
 * Tests.
 */
class MessageServiceTest extends TestCase {
    use AppTestTrait;

    /**
     * Test.
     * @return void
     */
    public function testCreateMessage(): void {
        $expectedMessage = new MessageData(1, 2, "testMessage");

        $this->mock(MessageRepository::class)->method('insertMessage')->willReturn(1);

        $service = $this->container->get(MessageService::class);

        $requestBody = ["from" => 1, "to" => 2, "body" => "testMessage"];

        $responseMessage = $service->createMessage($requestBody);

        $this->assertSame($responseMessage->getFrom(), $expectedMessage->getFrom());

        $this->assertSame($responseMessage->getTo(), $expectedMessage->getTo());

        $this->assertSame($responseMessage->getBody(), $expectedMessage->getBody());
    }

    /**
     * Test.
     * @return void
     */
    public function testReadMessages(): void {
        $message = new MessageData(1, 2, "testMessage");

        $expectedMessagesArray = array($message, $message); 

        $this->mock(MessageRepository::class)->method('readMessages')->willReturn($expectedMessagesArray);

        $this->mock(MessageService::class)->method('makeMessageResponseObject')->willReturn($expectedMessagesArray);

        $service = $this->container->get(MessageService::class);

        $requestBody = ["to" => 2];

        $responseMessagesArray = $service->readMessages($requestBody);

        $expectedSize = count($expectedMessagesArray);

        $this->assertSame(count($responseMessagesArray), $expectedSize);
        
    }

    /**
     * Test.
     *
     * @return void
     */
    public function testMissingParameterException(): void {
        $this->expectException(Exception::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessage("Could not resolve parameter `from`. Please check your input");

        $service = $this->container->get(MessageService::class);

        $requestBody = ["to" => 2, "body" => "testMessage"];

        $responseMessage = $service->createMessage($requestBody);
    }
}