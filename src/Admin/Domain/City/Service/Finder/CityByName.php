<?php

namespace App\Admin\Domain\City\Service\Finder;

use App\Admin\Domain\City\Model\City;
use App\Admin\Domain\City\Repository\CityRepository;
use App\Admin\Domain\Province\Model\Province;

class CityByName
{

    private CityRepository $cityRepository;

    public function __construct(
        CityRepository $cityRepository
    )
    {
        $this->cityRepository = $cityRepository;
    }

    public function __invoke(
        string $name
    ) : ?City
    {
        return $this->cityRepository->findByName($name);
    }

}