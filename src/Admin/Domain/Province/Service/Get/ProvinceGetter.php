<?php

namespace App\Admin\Domain\Province\Service\Get;

use App\Admin\Domain\Province\Exception\ProvinceNotFound;
use App\Admin\Domain\Province\Model\Province;
use App\Admin\Domain\Province\Repository\ProvinceRepository;
use Symfony\Component\Uid\Uuid;

class ProvinceGetter
{
    private ProvinceRepository $provinceRepository;

    public function __construct(
        ProvinceRepository $provinceRepository
    ){
        $this->provinceRepository = $provinceRepository;
    }

    /**
     * @param Uuid $id
     * @return Province
     * @throws ProvinceNotFound
     */
    public function __invoke(Uuid $id): Province
    {
        $province = $this->provinceRepository->findById($id);

        if(null === $province){
            throw new ProvinceNotFound($id);
        }

        return $province;
    }
}