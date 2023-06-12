<?php

namespace App\Tests\Admin\Domain\User\Service\Create;

use App\Admin\Domain\City\Model\City;
use App\Admin\Domain\Province\Model\Province;
use App\Admin\Domain\User\Repository\UserRepository;
use App\Admin\Domain\User\Service\Create\UserCreator;
use PHPUnit\Framework\TestCase;

class UserCreatorTest extends TestCase
{
    private UserCreator $userCreator;

    private UserRepository $userRepositoryMock;

    protected function setUp(): void
    {
        $this->userRepositoryMock = $this->createMock(UserRepository::class);

        $this->userCreator = new UserCreator(
            $this->userRepositoryMock
        );
    }

    public function testInvoke(){
        $this->userRepositoryMock->expects($this->once())
            ->method('save');

        $user = $this->userCreator->__invoke(
            'name',
            'lastName',
            44,
            'email@test.com',
            City::create(
                'city',
                Province::create('province')
            )
        );

        $this->assertEquals('name', $user->getName());
        $this->assertEquals('lastName', $user->getLastname());
        $this->assertEquals(44, $user->getAge());
        $this->assertEquals('email@test.com', $user->getEmail());
        $this->assertEquals('city', $user->getCity()->getName());
        $this->assertEquals('province', $user->getCity()->getProvince()->getName());
    }
}
