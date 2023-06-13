<?php

namespace App\Admin\Application\User\Find;

use App\Admin\Domain\User\Exception\AuthenticationNotFound;
use App\Admin\Domain\User\Exception\UserNotFoundByEmail;
use App\Admin\Domain\User\Model\Authentication;
use App\Admin\Domain\User\Model\User;
use App\Admin\Domain\User\Service\Get\AuthenticationGetterByUser;
use App\Admin\Domain\User\Service\Get\UserGetterByEmail;

class FindUserAuthenticationQueryHandler
{
    private AuthenticationGetterByUser $authenticationGetterByUser;

    private UserGetterByEmail $userGetterByEmail;

    public function __construct(
        AuthenticationGetterByUser $authenticationGetterByUser,
        UserGetterByEmail $userGetterByEmail
    )
    {
        $this->authenticationGetterByUser = $authenticationGetterByUser;
        $this->userGetterByEmail = $userGetterByEmail;
    }

    /**
     * @param FindUserAuthenticationQuery $query
     * @return User
     * @throws UserNotFoundByEmail
     * @throws AuthenticationNotFound
     */
    public function __invoke(FindUserAuthenticationQuery $query): Authentication
    {
        $user = $this->userGetterByEmail->__invoke($query->getEmail());
        return $this->authenticationGetterByUser->__invoke($user);
    }
}