<?php

namespace App\Admin\Domain\User\Exception;

use Symfony\Component\Uid\Uuid;

class AuthenticationNotFound extends \Exception {

    public function __construct(Uuid $id )
    {
        parent::__construct(
            sprintf(
                'User %s not have authentication data.',
                $id->jsonSerialize()
            )
        );
    }

}