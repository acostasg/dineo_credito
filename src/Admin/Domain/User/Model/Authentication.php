<?php

namespace App\Admin\Domain\User\Model;

use App\Admin\Domain\Shared\Model\AggregateRoot;
use Symfony\Component\Security\Core\User\UserInterface;

class Authentication extends AggregateRoot implements UserInterface
{
    private User $user;
    private string $email;
    private string $password;

    public function __construct(
        User $user,
        string $email,
        string $password
    )
    {
        parent::__construct();

        $this->user = $user;
        $this->email = $email;
        $this->password = $password;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        // TODO: Implement getRoles() method.
        return ['ROLE_USER'];
    }

    public function getSalt(): ?string
    {
        // TODO: Implement getSalt() method.
        return 'test';
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUsername(): string
    {
        // TODO: Implement getUsername() method.
        return $this->email;
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
    }

    public function getUserIdentifier(): string
    {
        return $this->user->getId()->toRfc4122();
    }
}