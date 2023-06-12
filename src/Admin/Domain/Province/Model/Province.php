<?php

namespace App\Admin\Domain\Province\Model;

use Symfony\Component\Uid\Uuid;


class Province
{
    private Uuid $id;
    private string $name;

    public function __construct(
        Uuid $id,
        string $name
    )
    {
        $this->id = $id;
        $this->name = $name;
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

    public static function create(
        string $name
    ): Province
    {
        return new self(
            Uuid::v4(),
            $name
        );
    }
}