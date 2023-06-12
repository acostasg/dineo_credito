<?php

namespace App\Admin\Domain\City\Service\Get;

use App\Admin\Domain\City\Exception\CityNotFound;
use App\Admin\Domain\City\Model\City;
use App\Admin\Domain\City\Repository\CityRepository;
use Symfony\Component\Uid\Uuid;

class CityGetter
{
    /**
     * @var CityRepository
     */
    private CityRepository $cityRepository;

    /**
     * @param CityRepository $cityRepository
     */
    public function __construct(
        CityRepository $cityRepository
    ){
        $this->cityRepository = $cityRepository;
    }

    /**
     * @param Uuid $id
     * @return City
     * @throws CityNotFound
     */
    public function __invoke(Uuid $id): City
    {
        $city = $this->cityRepository->findById($id);

        if(null === $city){
            throw new CityNotFound($id);
        }

        return $city;
    }
}