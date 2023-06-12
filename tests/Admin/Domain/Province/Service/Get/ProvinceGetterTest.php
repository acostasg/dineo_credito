<?php

namespace App\Tests\Admin\Domain\Province\Service\Get;

use App\Admin\Domain\Province\Exception\ProvinceNotFound;
use App\Admin\Domain\Province\Model\Province;
use App\Admin\Domain\Province\Repository\ProvinceRepository;
use App\Admin\Domain\Province\Service\Get\ProvinceGetter;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class ProvinceGetterTest extends TestCase
{
    private ProvinceGetter $provinceGetter;

    private ProvinceRepository $provinceRepositoryMock;

    protected function setUp(): void
    {
        $this->provinceRepositoryMock = $this->createMock(ProvinceRepository::class);

        $this->provinceGetter = new ProvinceGetter(
            $this->provinceRepositoryMock
        );
    }

    public function testInvoke()
    {
        $province = Province::create(
            'name'
        );
        $this->provinceRepositoryMock->expects($this->once())
            ->method('findById')
            ->with($province->getId())
            ->willReturn($province);

        $province = $this->provinceGetter->__invoke($province->getId());

        $this->assertEquals('name', $province->getName());
    }

    public function testInvokeNotFound()
    {
        $this->provinceRepositoryMock->expects($this->once())
            ->method('findById')
            ->willReturn(null);

        $this->expectException(ProvinceNotFound::class);

        $this->provinceGetter->__invoke(
            Uuid::v4()
        );
    }
}
