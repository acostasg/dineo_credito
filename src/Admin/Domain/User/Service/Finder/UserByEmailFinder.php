<?php

namespace App\Admin\Domain\User\Service\Finder;

use App\Admin\Domain\User\Model\User;
use App\Admin\Domain\User\Repository\UserRepository;

class UserByEmailFinder
{
    private UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(
        string $email
    ): ?User
    {
        return $this->userRepository->findByEmail($email);
    }
}