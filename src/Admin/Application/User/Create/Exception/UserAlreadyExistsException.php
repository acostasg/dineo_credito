<?php

namespace App\Admin\Application\User\Create\Exception;

class UserAlreadyExistsException extends \Exception
{
    public function __construct()
    {
        parent::__construct('User already exists');
    }
}