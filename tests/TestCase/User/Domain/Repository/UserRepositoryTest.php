<?php

namespace Test\TestCase\User\Domain\Repository;

use App\Test\AppTestTrait;
use App\Domain\User\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

/**
 * Tests.
*/
class UserRepositoryTest extends TestCase {
    use AppTestTrait;

     /**
     * Test.
     * @return void
     */
    public function testInsertUser(): void {
        $this->mock(UserRepository::class)->method('insertUser')->willReturn(1);

        $repository = $this->container->get(UserRepository::class);

        $username = "testUser";

        $result = $repository->insertUser($username);

        $this->assertSame(1, $result);
    }
    
}