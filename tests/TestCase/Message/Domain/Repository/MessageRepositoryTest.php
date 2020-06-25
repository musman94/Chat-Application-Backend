<?php

namespace Test\TestCase\Message\Domain\Repository;

use App\Test\AppTestTrait;
use App\Domain\Message\Data\MessageData;
use App\Domain\Message\Repository\MessageRepository;
use PHPUnit\Framework\TestCase;

/**
 * Tests.
*/
class MessageRepositoryTest extends TestCase {
    use AppTestTrait;

     /**
     * Test.
     * @return void
     */
    public function testInsertMessage(): void {
        $this->mock(MessageRepository::class)->method('insertMessage')->willReturn(1);

        $repository = $this->container->get(MessageRepository::class);

        $from = 1;
        $to = 2;
        $body = "testMessage";

        $result = $repository->insertMessage($from, $to, $body);

        $this->assertSame(1, $result);
    }
    
     /**
     * Test.
     * @return void
     */
    public function testReadMessages(): void {
        $messageOne = new MessageData(1, 2, "testMessageOne");
        $messageTwo = new MessageData(3, 2, "testMessageTwo");

        $expectedMessagesArray = array($messageOne, $messageTwo); 

        $this->mock(MessageRepository::class)->method('readMessages')->willReturn($expectedMessagesArray);
        
        $repository = $this->container->get(MessageRepository::class);

        $to = 2;

        $result = $repository->readMessages($to);

        $this->assertSame(2, count($result));
    }

}