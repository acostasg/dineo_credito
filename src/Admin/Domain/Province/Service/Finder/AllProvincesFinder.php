<?php

namespace App\Admin\Domain\Province\Service\Finder;

use App\Admin\Domain\Province\Model\Province;
use App\Admin\Domain\Province\Repository\ProvinceRepository;

class AllProvincesFinder
{
    private ProvinceRepository $provinceRepository;

    public function __construct(
        ProvinceRepository $provinceRepository
    )
    {
        $this->provinceRepository = $provinceRepository;
    }

    /**
     * @return Province[]
     */
    public function __invoke(): array
    {
        return $this->provinceRepository->findAll();
    }

}