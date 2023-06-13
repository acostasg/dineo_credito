<?php

namespace App\Tests\Admin\Domain\City\Service\Finder;

use App\Admin\Domain\City\Model\City;
use App\Admin\Domain\City\Repository\CityRepository;
use App\Admin\Domain\City\Service\Finder\CityByNameFinder;
use App\Admin\Domain\Province\Model\Province;
use PHPUnit\Framework\TestCase;

class CityByNameFinderTest extends TestCase
{
    private CityByNameFinder $cityByName;

    private CityRepository $cityRepositoryMock;

    public function setUp(): void
    {
        $this->cityRepositoryMock = $this->createMock(CityRepository::class);

        $this->cityByName = new CityByNameFinder(
            $this->cityRepositoryMock
        );
    }

    public function testInvoke()
    {
        $this->cityRepositoryMock->expects($this->once())
            ->method('findByName')
            ->willReturn(
                City::create(
                    'name',
                    Province::create('province')
                )
            );

        $city = $this->cityByName->__invoke('name');

        $this->assertEquals('name', $city->getName());
        $this->assertEquals('province', $city->getProvince()->getName());
    }

    public function testInvokeNull()
    {
        $this->cityRepositoryMock->expects($this->once())
            ->method('findByName')
            ->willReturn(null);

        $city = $this->cityByName->__invoke('name');

        $this->assertNull($city);
    }

}
