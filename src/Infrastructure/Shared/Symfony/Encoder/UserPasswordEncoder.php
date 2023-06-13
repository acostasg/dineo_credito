<?php

namespace App\Infrastructure\Shared\Symfony\Encoder;

use Symfony\Component\Security\Core\User\UserInterface;

class UserPasswordEncoder
{
    public function encodePassword(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }

    public function isPasswordValid(UserInterface $user, string $password): bool
    {
        return password_verify($password, $user->getPassword());
    }
}