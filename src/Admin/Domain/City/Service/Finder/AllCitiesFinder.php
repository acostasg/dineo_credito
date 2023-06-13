<?php

namespace App\Admin\Domain\City\Service\Finder;

use App\Admin\Domain\City\Model\City;
use App\Admin\Domain\City\Repository\CityRepository;
use App\Admin\Domain\Province\Model\Province;

class AllCitiesFinder
{

    private CityRepository $cityRepository;

    public function __construct(
        CityRepository $cityRepository
    )
    {
        $this->cityRepository = $cityRepository;
    }

    /**
     * @return City[]
     */
    public function __invoke() : array
    {
        return $this->cityRepository->findAll();
    }

}