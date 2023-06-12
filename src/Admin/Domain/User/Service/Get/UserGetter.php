<?php

namespace App\Admin\Domain\User\Service\Get;

use App\Admin\Domain\User\Exception\UserNotFound;
use App\Admin\Domain\User\Model\User;
use App\Admin\Domain\User\Repository\UserRepository;
use Symfony\Component\Uid\Uuid;

class UserGetter
{
    private UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws UserNotFound
     */
    public function __invoke(Uuid $id): User
    {
        $user = $this->userRepository->findById($id);

        if(null === $user){
            throw new UserNotFound($id);
        }
        return $user;
    }
}