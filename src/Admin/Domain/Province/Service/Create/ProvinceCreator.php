<?php

namespace App\Admin\Domain\Province\Service\Create;

use App\Admin\Domain\Province\Model\Province;
use App\Admin\Domain\Province\Repository\ProvinceRepository;

class ProvinceCreator
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
    ): Province
    {
        $province = Province::create(
            $name
        );

        $this->provinceRepository->save($province);
        return $province;
    }
}