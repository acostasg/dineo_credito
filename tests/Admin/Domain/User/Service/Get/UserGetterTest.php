<?php

namespace App\Tests\Admin\Domain\User\Service\Get;

use App\Admin\Domain\City\Model\City;
use App\Admin\Domain\Province\Model\Province;
use App\Admin\Domain\User\Exception\UserNotFound;
use App\Admin\Domain\User\Model\User;
use App\Admin\Domain\User\Repository\UserRepository;
use App\Admin\Domain\User\Service\Get\UserGetter;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class UserGetterTest extends TestCase
{
    private UserGetter $userGetter;

    private UserRepository $userRepositoryMock;

    public function setUp(): void
    {
        $this->userRepositoryMock = $this->createMock(UserRepository::class);

        $this->userGetter = new UserGetter(
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
            ->method('findById')
            ->with($user->getId())
            ->willReturn($user);

        $user = $this->userGetter->__invoke($user->getId());

        $this->assertEquals('name', $user->getName());
        $this->assertEquals('lastname', $user->getLastname());
        $this->assertEquals(44, $user->getAge());
        $this->assertEquals('email@test.com', $user->getEmail());
        $this->assertEquals('city', $user->getCity()->getName());
        $this->assertEquals('province', $user->getCity()->getProvince()->getName());
    }

    public function testInvokeNotFound()
    {
        $id = Uuid::v4();
        $this->userRepositoryMock->expects($this->once())
            ->method('findById')
            ->with($id)
            ->willReturn(
                    null
            );

        $this->expectException(UserNotFound::class);

        $this->userGetter->__invoke($id);
    }

}
