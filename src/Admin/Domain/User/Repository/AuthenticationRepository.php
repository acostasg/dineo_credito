<?php

namespace App\Admin\Domain\User\Repository;

use App\Admin\Domain\User\Model\Authentication;
use App\Admin\Domain\User\Model\User;

interface AuthenticationRepository
{
    public function findByUser(User $user): ?Authentication;
}