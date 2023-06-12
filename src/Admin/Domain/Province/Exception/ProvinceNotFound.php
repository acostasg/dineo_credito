<?php

namespace App\Admin\Domain\Province\Exception;

use Symfony\Component\Uid\Uuid;

class ProvinceNotFound extends \Exception {

    public function __construct(Uuid $id )
    {
        parent::__construct(
            sprintf(
                'Province with id %s not found',
                $id->jsonSerialize()
            )
        );
    }

}