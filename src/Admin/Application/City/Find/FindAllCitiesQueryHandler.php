<?php

namespace App\Admin\Application\City\Find;

use App\Admin\Domain\City\Service\Finder\AllCitiesFinder;

class FindAllCitiesQueryHandler
{
    private AllCitiesFinder $allCitiesFinder;

    public function __construct(
        AllCitiesFinder $allCitiesFinder
    )
    {
        $this->allCitiesFinder = $allCitiesFinder;
    }

    public function __invoke()
    {
        return $this->allCitiesFinder->__invoke();
    }
}