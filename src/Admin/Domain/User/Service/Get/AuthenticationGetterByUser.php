<?php

namespace App\Admin\Domain\User\Service\Get;

use App\Admin\Domain\User\Exception\AuthenticationNotFound;
use App\Admin\Domain\User\Model\Authentication;
use App\Admin\Domain\User\Model\User;
use App\Admin\Domain\User\Repository\AuthenticationRepository;

class AuthenticationGetterByUser
{
    private AuthenticationRepository $authenticationRepository;

    public function __construct(
        AuthenticationRepository $authenticationRepository
    )
    {
        $this->authenticationRepository = $authenticationRepository;
    }

    /**
     * @throws AuthenticationNotFound
     */
    public function __invoke(User $user): Authentication
    {
        $authentication = $this->authenticationRepository->findByUser($user);

        if(null === $authentication){
            throw new AuthenticationNotFound($user->getId());
        }
        return $authentication;
    }
}