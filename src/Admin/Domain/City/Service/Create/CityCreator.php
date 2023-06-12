<?php

namespace App\Admin\Domain\City\Service\Create;

use App\Admin\Domain\City\Model\City;
use App\Admin\Domain\City\Repository\CityRepository;
use App\Admin\Domain\Province\Model\Province;

class CityCreator
{
    private CityRepository $cityRepository;

    public function __construct(
        CityRepository $cityRepository
    )
    {
        $this->cityRepository = $cityRepository;
    }

    public function __invoke(
        string $name,
        Province $province
    )
    {
        $city = City::create(
            $name,
            $province
        );
        $this->cityRepository->save($city);
        return $city;
    }

}