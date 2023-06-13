<?php

namespace App\Tests\Admin\Application\User\Find;

use App\Admin\Application\User\Find\FindUserByEmailHandler;
use App\Admin\Application\User\Find\FindUserByEmailQuery;
use App\Admin\Domain\City\Model\City;
use App\Admin\Domain\Province\Model\Province;
use App\Admin\Domain\User\Model\User;
use App\Admin\Domain\User\Service\Get\UserGetterByEmail;
use PHPUnit\Framework\TestCase;

class FindUserByEmailHandlerTest extends TestCase
{
    private FindUserByEmailHandler $findUserByEmailHandler;

    private UserGetterByEmail $userGetterByEmailMock;

    protected function setUp(): void
    {
        $this->userGetterByEmailMock = $this->createMock(UserGetterByEmail::class);
        $this->findUserByEmailHandler = new FindUserByEmailHandler($this->userGetterByEmailMock);
    }

    /**
     * @test
     */
    public function testInvoke()
    {
        $user = User::create(
            'name',
            'lastname',
            10,
            'email@test.com',
            City::create(
                'city',
                Province::create('province')
            )
        );

        $this->userGetterByEmailMock->expects($this->once())
            ->method('__invoke')
            ->willReturn($user);

        $result = $this->findUserByEmailHandler->__invoke(
            new FindUserByEmailQuery('email@test.com')
        );

        $this->assertEquals($user, $result);
    }
}
