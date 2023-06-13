<?php

namespace App\Infrastructure\Shared\Doctrine\Repository;

use App\Admin\Domain\User\Model\Authentication;
use App\Admin\Domain\User\Model\User;
use App\Admin\Domain\User\Repository\AuthenticationRepository;

class AuthenticationDoctrineRepository extends DoctrineRepository implements AuthenticationRepository
{

    public function findByUser(User $user): ?Authentication
    {
       $this->getRepository()->findOneBy(['user' => $user]);
    }

    protected function getRepositoryName(): string
    {
        return Authentication::class;
    }
}