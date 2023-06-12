<?php

namespace App\Admin\Domain\User\Repository;

use App\Admin\Domain\User\Model\User;
use Symfony\Component\Uid\Uuid;

interface  UserRepository
{
    public function findAll(): array;

    public function findById(Uuid $id): ?User;

    public function findByEmail(string $email): ?User;

    public function save(User $user): void;

    public function remove(User $user): void;
}