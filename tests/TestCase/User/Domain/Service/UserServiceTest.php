<?php

namespace Test\TestCase\User\Domain\Service;

use Exception;
use App\Test\AppTestTrait;
use App\Domain\User\Data\UserData;
use App\Domain\User\Repository\UserRepository;
use App\Domain\User\Service\UserService;
use PHPUnit\Framework\TestCase;

/**
 * Tests.
 */
class UserServiceTest extends TestCase {
    use AppTestTrait;

    /**
     * Test.
     *
     * @return void
     */
    public function testCreateUser(): void {
        $userID = 1;
        $username = "testUser";

        $expectedUser = new UserData($userID, $username);

        $this->mock(UserRepository::class)->method('insertUser')->willReturn($userID);

        $service = $this->container->get(UserService::class);

        $requestBody = ["username" => "testUser"];

        $responseUser = $service->createUser($requestBody);

        $this->assertSame($responseUser->getId(), $expectedUser->getId());

        $this->assertSame($responseUser->getUsername(), $expectedUser->getUsername());
    }

    /**
     * Test.
     *
     * @return void
     */
    public function testMissingParameterException(): void {
        $this->expectException(Exception::class);
        $this->expectExceptionCode(400);
        $this->expectExceptionMessage("Could not resolve parameter `username`. Please check your input");

        $service = $this->container->get(UserService::class);

        $requestBody = [];

        $responseUser = $service->createUser($requestBody);
    }
}