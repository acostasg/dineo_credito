<?php

namespace App\Admin\Domain\User\Model;
use App\Admin\Domain\City\Model\City;
use App\Admin\Domain\Shared\Model\AggregateRoot;
use Symfony\Component\Uid\Uuid;
class User extends AggregateRoot
{
    private Uuid $id;
    private string $name;
    private string $lastName;
    private int $age;
    private string $email;
    private City $city;

    public function __construct(
        Uuid $id,
        string $name,
        string $lastName,
        int $age,
        string $email,
        City $city
    )
    {
        parent::__construct();
        $this->id = $id;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->email = $email;
        $this->city = $city;
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
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
     * @return City
     */
    public function getCity(): City
    {
        return $this->city;
    }
    public static function create(
        string $name,
        string $lastName,
        int $age,
        string $email,
        City $city
    ): User
    {
        return new self(
            Uuid::v4(),
            $name,
            $lastName,
            $age,
            $email,
            $city
        );
    }

}