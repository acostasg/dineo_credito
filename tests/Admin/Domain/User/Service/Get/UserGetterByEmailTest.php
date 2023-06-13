<?php

namespace App\Tests\Admin\Domain\User\Service\Get;

use App\Admin\Domain\City\Model\City;
use App\Admin\Domain\Province\Model\Province;
use App\Admin\Domain\User\Exception\UserNotFoundByEmail;
use App\Admin\Domain\User\Model\User;
use App\Admin\Domain\User\Repository\UserRepository;
use App\Admin\Domain\User\Service\Get\UserGetterByEmail;
use PHPUnit\Framework\TestCase;

class UserGetterByEmailTest extends TestCase
{
    private UserGetterByEmail $userGetterByEmail;

    private UserRepository $userRepositoryMock;

    public function setUp(): void
    {
        $this->userRepositoryMock = $this->createMock(UserRepository::class);

        $this->userGetterByEmail = new UserGetterByEmail(
            $this->userRepositoryMock
        );
    }

    public function testInvoke()
    {
        $user = User::create(
            'name',
            'lastname',
            44,
            'email@test.com',
            City::create(
                'city',
                Province::create('province')
            )
        );

        $this->userRepositoryMock->expects($this->once())
            ->method('findByEmail')
            ->with($user->getEmail())
            ->willReturn($user);

        $user = $this->userGetterByEmail->__invoke($user->getEmail());

        $this->assertEquals('name', $user->getName());
        $this->assertEquals('lastname', $user->getLastname());
        $this->assertEquals(44, $user->getAge());
        $this->assertEquals('email@test.com', $user->getEmail());
        $this->assertEquals('city', $user->getCity()->getName());
        $this->assertEquals('province', $user->getCity()->getProvince()->getName());
    }

    public function testInvokeNotFound()
    {
        $this->userRepositoryMock->expects($this->once())
            ->method('findByEmail')
            ->with('email@test.com')
            ->willReturn(
                null
            );

        $this->expectException(UserNotFoundByEmail::class);

        $this->userGetterByEmail->__invoke('email@test.com');
    }

}
