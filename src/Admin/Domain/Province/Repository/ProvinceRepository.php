<?php

namespace App\Admin\Domain\Province\Repository;

use App\Admin\Domain\Province\Model\Province;
use Symfony\Component\Uid\Uuid;

interface ProvinceRepository
{
    public function findAll(): array;

    public function findById(Uuid $id): ?Province;

    public function findByName(string $name): ?Province;

    public function save(Province $user): void;

    public function remove(Province $user): void;
}