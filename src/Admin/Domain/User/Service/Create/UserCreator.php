<?php

namespace App\Admin\Domain\User\Service\Create;

use App\Admin\Domain\City\Model\City;
use App\Admin\Domain\User\Model\User;
use App\Admin\Domain\User\Repository\UserRepository;

class UserCreator
{
    private UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(
        string $name,
        string $lastName,
        int $age,
        string $email,
        City $city
    ): User
    {
        $user = User::create(
            $name,
            $lastName,
            $age,
            $email,
            $city
        );

        $this->userRepository->save($user);
        return $user;
    }
}