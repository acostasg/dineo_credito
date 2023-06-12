<?php

namespace App\Infrastructure\Shared\Doctrine\Repository;

use App\Admin\Domain\City\Model\City;
use App\Admin\Domain\City\Repository\CityRepository;
use Symfony\Component\Uid\Uuid;

class CityDoctrineRepository extends DoctrineRepository implements CityRepository
{

    public function findAll(): array
    {
        return $this->getRepository()->findAll();
    }

    public function findAllByProvinceId(Uuid $provinceId): array
    {
        return $this->getRepository()->findBy(['provinceId' => $provinceId]);
    }

    public function findById(Uuid $id): ?City
    {
        return $this->getRepository()->find($id);
    }

    public function findByName(string $name): ?City
    {
        return $this->getRepository()->findOneBy(['name' => $name]);
    }

    public function save(City $city): void
    {
        $this->getRepository()->save($city);
    }

    public function remove(City $city): void
    {
        $this->getRepository()->remove($city);
    }

    protected function getRepositoryName(): string
    {
        return City::class;
    }
}