<?php

namespace App\Infrastructure\Shared\Symfony\Provider;


use App\Admin\Application\User\Find\FindUserAuthenticationQuery;
use App\Admin\Application\User\Find\FindUserAuthenticationQueryHandler;
use App\Admin\Domain\User\Exception\AuthenticationNotFound;
use App\Admin\Domain\User\Model\Authentication;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class UserProvider implements UserProviderInterface
{

    private FindUserAuthenticationQueryHandler $handler;


    public function __construct(FindUserAuthenticationQueryHandler $handler)
    {
        $this->handler = $handler;
    }

    public function loadUserByUsername(string $email): Authentication
    {
        return $this->handler->__invoke(
            new FindUserAuthenticationQuery($email)
        );
    }

    public function refreshUser(UserInterface $user): Authentication
    {
        assert($user instanceof Authentication);

        if (null === $reloadedUser = $this->loadUserByUsername($user->getEmail())) {
            throw new AuthenticationNotFound($user->getId());
        }

        return $reloadedUser;
    }

    public function supportsClass($class): bool
    {
        return $class === Authentication::class;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        return $this->loadUserByUsername($identifier);
    }
}