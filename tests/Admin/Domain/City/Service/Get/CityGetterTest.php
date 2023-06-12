<?php

namespace App\Tests\Admin\Domain\City\Service\Get;

use App\Admin\Domain\City\Exception\CityNotFound;
use App\Admin\Domain\City\Model\City;
use App\Admin\Domain\City\Repository\CityRepository;
use App\Admin\Domain\City\Service\Get\CityGetter;
use App\Admin\Domain\Province\Model\Province;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class CityGetterTest extends TestCase
{
    private CityGetter $cityGetter;

    private CityRepository $cityRepositoryMock;

    protected function setUp(): void
    {
        $this->cityRepositoryMock = $this->createMock(CityRepository::class);

        $this->cityGetter = new CityGetter(
            $this->cityRepositoryMock
        );
    }

    public function testInvoke()
    {
        $city = City::create(
            'name',
            Province::create('province')
        );

        $this->cityRepositoryMock->expects($this->once())
            ->method('findById')
            ->with($city->getId())
            ->willReturn($city);

        $city = $this->cityGetter->__invoke(
            $city->getId()
        );

        $this->assertEquals('name', $city->getName());
        $this->assertEquals('province', $city->getProvince()->getName());
    }

    public function testInvokeNotFound()
    {
        $this->cityRepositoryMock->expects($this->once())
            ->method('findById')
            ->willReturn(null);


        $this->expectException(CityNotFound::class);

        $this->cityGetter->__invoke(
            Uuid::v4()
        );
    }
}
