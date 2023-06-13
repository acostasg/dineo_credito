<?php

namespace App\Admin\Domain\Province\Service\Finder;

use App\Admin\Domain\Province\Model\Province;
use App\Admin\Domain\Province\Repository\ProvinceRepository;

class ProvinceByNameFinder
{
    private ProvinceRepository $provinceRepository;

    public function __construct(
        ProvinceRepository $provinceRepository
    )
    {
        $this->provinceRepository = $provinceRepository;
    }

    public function __invoke(
        string $name
    ): ?Province
    {
        return $this->provinceRepository->findByName($name);
    }

}