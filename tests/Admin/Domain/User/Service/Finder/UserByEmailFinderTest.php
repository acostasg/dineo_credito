<?php

namespace App\Tests\Admin\Domain\User\Service\Finder;

use App\Admin\Domain\City\Model\City;
use App\Admin\Domain\Province\Model\Province;
use App\Admin\Domain\User\Model\User;
use App\Admin\Domain\User\Repository\UserRepository;
use App\Admin\Domain\User\Service\Finder\UserByEmailFinder;
use PHPUnit\Framework\TestCase;

class UserByEmailFinderTest extends TestCase
{
    private UserByEmailFinder $userByEmailFinder;

    private UserRepository $userRepositoryMock;

    public function setUp(): void
    {
        $this->userRepositoryMock = $this->createMock(UserRepository::class);

        $this->userByEmailFinder = new UserByEmailFinder(
            $this->userRepositoryMock
        );
    }

    public function testInvoke()
    {
        $this->userRepositoryMock->expects($this->once())
            ->method('findByEmail')
            ->willReturn(
                User::create(
                    'name',
                    'lastName',
                    44,
                    'email@test.com',
                    City::create(
                        'city',
                        Province::create('province')
                    )
                )
            );

        $user = $this->userByEmailFinder->__invoke('email@test.com');

        $this->assertEquals('name', $user->getName());
        $this->assertEquals('lastName', $user->getLastname());
        $this->assertEquals(44, $user->getAge());
        $this->assertEquals('email@test.com', $user->getEmail());
        $this->assertEquals('city', $user->getCity()->getName());
        $this->assertEquals('province', $user->getCity()->getProvince()->getName());
    }

    public function testInvokeNotFound()
    {
        $this->userRepositoryMock->expects($this->once())
            ->method('findByEmail')
            ->willReturn(null);


        $user = $this->userByEmailFinder->__invoke('test@email.com');
        $this->assertNull($user);
    }

}
