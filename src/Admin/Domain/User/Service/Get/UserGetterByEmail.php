<?php

namespace App\Admin\Domain\User\Service\Get;

use App\Admin\Domain\User\Exception\UserNotFound;
use App\Admin\Domain\User\Exception\UserNotFoundByEmail;
use App\Admin\Domain\User\Model\User;
use App\Admin\Domain\User\Repository\UserRepository;

class UserGetterByEmail
{
    private UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws UserNotFoundByEmail
     */
    public function __invoke(string $email): User
    {
        $user = $this->userRepository->findByEmail($email);

        if(null === $user){
            throw new UserNotFoundByEmail($email);
        }
        return $user;
    }
}