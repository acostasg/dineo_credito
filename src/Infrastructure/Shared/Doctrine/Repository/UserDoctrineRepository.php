<?php

namespace App\Infrastructure\Shared\Doctrine\Repository;

use App\Admin\Domain\User\Model\User;
use App\Admin\Domain\User\Repository\UserRepository;
use Symfony\Component\Uid\Uuid;

class UserDoctrineRepository extends  DoctrineRepository implements UserRepository
{

    protected function getRepositoryName(): string
    {
        return User::class;
    }

    public function findAll(): array
    {
        return $this->getRepository()->findAll();
    }

    public function findById(Uuid $id): ?User
    {
        return $this->getRepository()->find($id);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->getRepository()->findOneBy(['email' => $email]);
    }

    public function save(User $user): void
    {
        $this->getRepository()->save($user);
    }

    public function remove(User $user): void
    {
        $this->getRepository()->remove($user);
    }
}