<?php

namespace App\Admin\Application\User\Find;

use App\Admin\Domain\User\Exception\UserNotFoundByEmail;
use App\Admin\Domain\User\Model\User;
use App\Admin\Domain\User\Service\Get\UserGetterByEmail;

class FindUserByEmailHandler
{

    private UserGetterByEmail $getter;

    public function __construct(
        UserGetterByEmail $getter
    )
    {
        $this->getter = $getter;
    }

    /**
     * @throws UserNotFoundByEmail
     */
    public function __invoke(
        FindUserByEmailQuery $query
    ) : User {
            return $this->getter->__invoke($query->getEmail());
    }
}