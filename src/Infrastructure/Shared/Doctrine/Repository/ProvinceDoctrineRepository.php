<?php

namespace App\Infrastructure\Shared\Doctrine\Repository;

use App\Admin\Domain\Province\Model\Province;
use App\Admin\Domain\Province\Repository\ProvinceRepository;
use Symfony\Component\Uid\Uuid;

class ProvinceDoctrineRepository  extends DoctrineRepository implements ProvinceRepository
{

    protected function getRepositoryName(): string
    {
        return Province::class;
    }

    public function findAll(): array
    {
        return $this->getRepository()->findAll();
    }

    public function findById(Uuid $id): ?Province
    {
        return $this->getRepository()->find($id);
    }

    public function findByName(string $name): ?Province
    {
        return $this->getRepository()->findOneBy(['name' => $name]);
    }

    public function save(Province $user): void
    {
        $this->getRepository()->save($user);
    }

    public function remove(Province $user): void
    {
        $this->getRepository()->remove($user);
    }
}