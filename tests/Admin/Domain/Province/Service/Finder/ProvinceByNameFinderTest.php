<?php

namespace App\Tests\Admin\Domain\Province\Service\Finder;

use App\Admin\Domain\Province\Model\Province;
use App\Admin\Domain\Province\Repository\ProvinceRepository;
use App\Admin\Domain\Province\Service\Finder\ProvinceByNameFinder;
use PHPUnit\Framework\TestCase;

class ProvinceByNameFinderTest extends TestCase
{
    private ProvinceByNameFinder $provinceByName;

    private ProvinceRepository $provinceRepositoryMock;

    public function setUp(): void
    {
        $this->provinceRepositoryMock = $this->createMock(ProvinceRepository::class);

        $this->provinceByName = new ProvinceByNameFinder(
            $this->provinceRepositoryMock
        );
    }

    public function testInvoke()
    {
        $this->provinceRepositoryMock->expects($this->once())
            ->method('findByName')
            ->willReturn(
                Province::create(
                    'name'
                )
            );

        $province = $this->provinceByName->__invoke('name');

        $this->assertEquals('name', $province->getName());
    }

    public function testInvokeNull()
    {
        $this->provinceRepositoryMock->expects($this->once())
            ->method('findByName')
            ->willReturn(null);

        $province = $this->provinceByName->__invoke('name');

        $this->assertNull($province);
    }
}
