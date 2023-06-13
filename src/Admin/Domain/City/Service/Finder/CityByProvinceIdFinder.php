<?php

namespace App\Admin\Domain\City\Service\Finder;

use App\Admin\Domain\City\Repository\CityRepository;
use Symfony\Component\Uid\Uuid;

class CityByProvinceIdFinder
{

    private CityRepository $cityRepository;

    public function __construct(
        CityRepository $cityRepository
    )
    {
        $this->cityRepository = $cityRepository;
    }

    public function __invoke(
        Uuid $provinceId
    ): array
    {
        return $this->cityRepository->findAllByProvinceId($provinceId);
    }
}