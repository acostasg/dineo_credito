<?php

namespace App\Tests\Admin\Domain\City\Service\Finder;

use App\Admin\Domain\City\Model\City;
use App\Admin\Domain\City\Repository\CityRepository;
use App\Admin\Domain\City\Service\Finder\AllCitiesFinder;
use PHPUnit\Framework\TestCase;

class AllCitiesByNameFinderTest extends TestCase
{
    private AllCitiesFinder $allCitiesByName;

    private CityRepository $cityRepositoryMock;

    protected function setUp(): void
    {
        $this->cityRepositoryMock = $this->createMock(CityRepository::class);
        $this->allCitiesByName = new AllCitiesFinder($this->cityRepositoryMock);
    }

    public function testInvoke()
    {
        $this->cityRepositoryMock->expects($this->once())
            ->method('findAll')
            ->willReturn([]);

        $this->assertIsArray(($this->allCitiesByName)());
    }

    public function testInvokeWithResults()
    {
        $this->cityRepositoryMock->expects($this->once())
            ->method('findAll')
            ->willReturn([
                $this->createMock(City::class),
                $this->createMock(City::class),
                $this->createMock(City::class),
            ]);

        $result = ($this->allCitiesByName)();
        $this->assertIsArray($result);
        $this->assertCount(3, $result);
    }
}
