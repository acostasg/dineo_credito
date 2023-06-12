<?php

namespace App\Admin\Domain\City\Repository;

use App\Admin\Domain\City\Model\City;
use Symfony\Component\Uid\Uuid;

interface CityRepository
{
    public function findAll(): array;

    /**
     * @param Uuid $provinceId
     * @return City[]
     */
    public function findAllByProvinceId(Uuid $provinceId): array;

    public function findById(Uuid $id): ?City;

    public function findByName(string $name): ?City;

    public function save(City $city): void;

    public function remove(City $city): void;
}