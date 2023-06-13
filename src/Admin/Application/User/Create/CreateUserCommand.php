<?php

namespace App\Admin\Application\User\Create;

class CreateUserCommand
{
    private string $name;
    private string $lastName;
    private int $age;
    private string $email;
    private string $cityId;

    public function __construct(
        string $name,
        string $lastName,
        int $age,
        string $email,
        string $cityId
    )
    {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->email = $email;
        $this->cityId = $cityId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getCityId(): string
    {
        return $this->cityId;
    }

}