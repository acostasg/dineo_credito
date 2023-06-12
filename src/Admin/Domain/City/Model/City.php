<?php

namespace App\Admin\Domain\City\Model;

use App\Admin\Domain\Province\Model\Province;
use App\Admin\Domain\Shared\Model\AggregateRoot;
use Symfony\Component\Uid\Uuid;

class City extends AggregateRoot
{
    private Uuid $id;
    private string $name;
    private Province $province;

    public function __construct(
        Uuid $id,
        string $name,
        Province $province
    )
    {
        parent::__construct();
        $this->id = $id;
        $this->name = $name;
        $this->province = $province;
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getProvince(): Province
    {
        return $this->province;
    }

    public static function create(
        string $name,
        Province $province
    ): City
    {
        return new self(
            Uuid::v4(),
            $name,
            $province
        );
    }

}