<?php

namespace App\Admin\Application\Province\Find;

use App\Admin\Domain\Province\Model\Province;
use App\Admin\Domain\Province\Service\Finder\AllProvincesFinder;

class FindAllProvincesHandler
{
    private AllProvincesFinder $service;

    public function __construct(
        AllProvincesFinder $service
    )
    {
        $this->service = $service;
    }

    /**
     * @return Province[]
     */
    public function __invoke(): array
    {
        return $this->service->__invoke();
    }
}