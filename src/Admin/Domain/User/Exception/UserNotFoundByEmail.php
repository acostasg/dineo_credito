<?php

namespace App\Admin\Domain\User\Exception;

use Symfony\Component\Uid\Uuid;

class UserNotFoundByEmail extends \Exception {

    public function __construct(string $id )
    {
        parent::__construct(
            sprintf(
                'User with email %s not found',
                $id
            )
        );
    }

}