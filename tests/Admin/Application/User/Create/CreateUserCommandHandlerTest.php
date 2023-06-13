<?php

namespace App\Tests\Admin\Application\User\Create;

use App\Admin\Application\User\Create\CreateUserCommand;
use App\Admin\Application\User\Create\CreateUserCommandHandler;
use App\Admin\Application\User\Create\Exception\UserAlreadyExistsException;
use App\Admin\Domain\City\Model\City;
use App\Admin\Domain\City\Service\Get\CityGetter;
use App\Admin\Domain\Province\Model\Province;
use App\Admin\Domain\User\Model\User;
use App\Admin\Domain\User\Service\Create\UserCreator;
use App\Admin\Domain\User\Service\Finder\UserByEmailFinder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\UuidV4;

class CreateUserCommandHandlerTest extends TestCase
{
    private CreateUserCommandHandler $createUserCommandHandler;

    private UserCreator $userCreatorMock;

    private UserByEmailFinder $userByEmailFinderMock;

    private CityGetter $cityGetterMock;

    protected function setUp(): void
    {
        $this->userCreatorMock = $this->createMock(UserCreator::class);
        $this->userByEmailFinderMock = $this->createMock(UserByEmailFinder::class);
        $this->cityGetterMock = $this->createMock(CityGetter::class);

        $this->createUserCommandHandler = new CreateUserCommandHandler(
            $this->userCreatorMock,
            $this->userByEmailFinderMock,
            $this->cityGetterMock
        );
    }

    public function testInvoke()
    {
        $user = $this->getUser();

        $this->userByEmailFinderMock->expects($this->once())
            ->method('__invoke')
            ->willReturn(null);

        $this->cityGetterMock->expects($this->once())
            ->method('__invoke')
            ->willReturn(
                City::create(
                    'city',
                    Province::create('province')
                )
            );

        $this->userCreatorMock->expects($this->once())
            ->method('__invoke')
            ->willReturn($user);

        $result = $this->createUserCommandHandler->__invoke(
            new CreateUserCommand(
                'name',
                'lastName',
                18,
                'email',
                UuidV4::v4()->toRfc4122()
            )
        );

        $this->assertEquals($user, $result);

    }

    public function testInvokeUserExists()
    {
        $user = $this->getUser();

        $this->userByEmailFinderMock->expects($this->once())
            ->method('__invoke')
            ->willReturn($user);

        $this->expectException(UserAlreadyExistsException::class);

        $this->createUserCommandHandler->__invoke(
            new CreateUserCommand(
                'name',
                'lastName',
                18,
                'email',
                'city'
            )
        );

    }

    /**
     * @return User
     */
    private function getUser(): User
    {
        return User::create(
            'name',
            'lastName',
            18,
            'email',
            City::create(
                'city',
                Province::create('province'
                )
            )
        );
    }
}
