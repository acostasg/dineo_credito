<?php

namespace App\Admin\Application\User\Find\Validator;

use App\Admin\Application\User\Find\FindUserByEmailQuery;

class FindUserByEmailQueryValidator
{
    public function __invoke(FindUserByEmailQuery $query)
    {
        //TODO add valitation and used symfony validator with interface

        if (empty($query->getEmail())) {
            throw new \InvalidArgumentException('Email is required');
        }
    }

}