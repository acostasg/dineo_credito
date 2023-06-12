<?php

namespace App\Admin\Domain\City\Exception;

use Symfony\Component\Uid\Uuid;

class CityNotFound extends \Exception {

    public function __construct(Uuid $id )
    {
        parent::__construct(
            sprintf(
                'City with id %s not found',
                $id->jsonSerialize()
            )
        );
    }

}