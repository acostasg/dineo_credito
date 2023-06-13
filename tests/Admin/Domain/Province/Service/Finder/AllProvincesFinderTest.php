<?php

namespace App\Tests\Admin\Domain\Province\Service\Finder;

use App\Admin\Domain\Province\Model\Province;
use App\Admin\Domain\Province\Repository\ProvinceRepository;
use App\Admin\Domain\Province\Service\Finder\AllProvincesFinder;
use PHPUnit\Framework\TestCase;

class AllProvincesFinderTest extends TestCase
{
    private AllProvincesFinder $allProvincesFinder;

    private ProvinceRepository $provinceRepositoryMock;

    protected function setUp(): void
    {
        $this->provinceRepositoryMock = $this->createMock(ProvinceRepository::class);
        $this->allProvincesFinder = new AllProvincesFinder($this->provinceRepositoryMock);
    }

    public function testInvoke()
    {
        $this->provinceRepositoryMock->expects($this->once())
            ->method('findAll')
            ->willReturn([]);

        $this->assertIsArray(($this->allProvincesFinder)());
    }

    public function testInvokeWithResults()
    {
        $this->provinceRepositoryMock->expects($this->once())
            ->method('findAll')
            ->willReturn([
                $this->createMock(Province::class),
                $this->createMock(Province::class),
                $this->createMock(Province::class),
            ]);

        $result = ($this->allProvincesFinder)();
        $this->assertIsArray($result);
        $this->assertCount(3, $result);
    }

}
