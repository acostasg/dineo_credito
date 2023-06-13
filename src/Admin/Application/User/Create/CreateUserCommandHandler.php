<?php

namespace App\Admin\Application\User\Create;

use App\Admin\Application\User\Create\Exception\UserAlreadyExistsException;
use App\Admin\Domain\City\Exception\CityNotFound;
use App\Admin\Domain\City\Service\Get\CityGetter;
use App\Admin\Domain\User\Model\User;
use App\Admin\Domain\User\Service\Create\UserCreator;
use App\Admin\Domain\User\Service\Finder\UserByEmailFinder;
use Symfony\Component\Uid\Uuid;

class CreateUserCommandHandler
{
    private UserCreator $creator;
    private UserByEmailFinder $finder;
    private CityGetter $cityGetter;

    public function __construct(
        UserCreator       $creator,
        UserByEmailFinder $finder,
        CityGetter        $cityGetter
    )
    {
        $this->creator = $creator;
        $this->finder = $finder;
        $this->cityGetter = $cityGetter;
    }

    /**
     * @throws UserAlreadyExistsException
     * @throws CityNotFound
     */
    public function __invoke(CreateUserCommand $command): User
    {
        $userValidation = $this->finder->__invoke($command->getEmail());

        if (null !== $userValidation) {
            throw new UserAlreadyExistsException();
        }

        $uuidCity = Uuid::fromString($command->getCityId());

        return $this->creator->__invoke(
            $command->getName(),
            $command->getLastName(),
            $command->getAge(),
            $command->getEmail(),
            $this->cityGetter->__invoke($uuidCity)
        );
    }
}