<?php

namespace App\Admin\Domain\User\Exception;

use Symfony\Component\Uid\Uuid;

class UserNotFound extends \Exception {

    public function __construct(Uuid $id )
    {
        parent::__construct(
            sprintf(
                'User with id %s not found',
                $id->jsonSerialize()
            )
        );
    }

}