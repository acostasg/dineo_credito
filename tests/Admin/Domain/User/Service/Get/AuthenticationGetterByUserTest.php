<?php

namespace App\Tests\Admin\Domain\User\Service\Get;

use App\Admin\Domain\City\Model\City;
use App\Admin\Domain\Province\Model\Province;
use App\Admin\Domain\User\Exception\AuthenticationNotFound;
use App\Admin\Domain\User\Model\Authentication;
use App\Admin\Domain\User\Model\User;
use App\Admin\Domain\User\Repository\AuthenticationRepository;
use App\Admin\Domain\User\Service\Get\AuthenticationGetterByUser;
use PHPUnit\Framework\TestCase;

class AuthenticationGetterByUserTest extends TestCase
{
    private AuthenticationGetterByUser $authenticationGetterByUser;

    private AuthenticationRepository $authenticationRepositoryMock;

    public function setUp(): void
    {
        $this->authenticationRepositoryMock = $this->createMock(AuthenticationRepository::class);

        $this->authenticationGetterByUser = new AuthenticationGetterByUser(
            $this->authenticationRepositoryMock
        );
    }

    public function testInvoke()
    {
        $user = $this->getUser();

        $authentication = Authentication::create(
            $user,
            $user->getEmail(),
            'password'
        );

        $this->authenticationRepositoryMock->expects($this->once())
            ->method('findByUser')
            ->with($user)
            ->willReturn($authentication);

        $result = $this->authenticationGetterByUser->__invoke($user);

        $this->assertEquals($authentication->getId(), $result->getId());
        $this->assertEquals($authentication->getUser()->getId(), $result->getUser()->getId());
        $this->assertEquals($authentication->getEmail(), $result->getEmail());
        $this->assertEquals($authentication->getPassword(), $result->getPassword());
    }

    public function testInvokeNotFound()
    {
        $user = $this->getUser();

        $this->authenticationRepositoryMock->expects($this->once())
            ->method('findByUser')
            ->with($user)
            ->willReturn(null);

        $this->expectException(AuthenticationNotFound::class);

        $this->authenticationGetterByUser->__invoke($user);

    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return User::create(
            'name',
            'lastname',
            44,
            'email@test.com',
            City::create(
                'city',
                Province::create('province')
            )
        );
    }
}
