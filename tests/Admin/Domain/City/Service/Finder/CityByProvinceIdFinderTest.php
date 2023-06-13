<?php

namespace App\Tests\Admin\Domain\City\Service\Finder;

use App\Admin\Domain\City\Repository\CityRepository;
use App\Admin\Domain\City\Service\Finder\CityByProvinceIdFinder;
use App\Admin\Domain\Province\Model\Province;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class CityByProvinceIdFinderTest extends TestCase
{
    private CityByProvinceIdFinder $cityByProvinceId;

    private CityRepository $cityRepositoryMock;

    public function setUp(): void
    {
        $this->cityRepositoryMock = $this->createMock(CityRepository::class);

        $this->cityByProvinceId = new CityByProvinceIdFinder(
            $this->cityRepositoryMock
        );
    }

    public function testInvoke(){
        $this->cityRepositoryMock->expects($this->once())
            ->method('findAllByProvinceId')
            ->willReturn(
                [
                    Province::create('province'),
                    Province::create('province2')
                ]
            );

        $cities = $this->cityByProvinceId->__invoke(Uuid::v4());

        $this->assertEquals('province', $cities[0]->getName());
        $this->assertEquals('province2', $cities[1]->getName());
    }
}
