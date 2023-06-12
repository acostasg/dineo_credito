<?php

namespace App\Tests\Admin\Domain\Province\Service\Create;

use App\Admin\Domain\Province\Repository\ProvinceRepository;
use App\Admin\Domain\Province\Service\Create\ProvinceCreator;
use PHPUnit\Framework\TestCase;

class ProvinceCreatorTest extends TestCase
{
    private ProvinceCreator $provinceCreator;

    private ProvinceRepository $provinceRepositoryMock;

    protected function setUp(): void
    {
        $this->provinceRepositoryMock = $this->createMock(ProvinceRepository::class);

        $this->provinceCreator = new ProvinceCreator(
            $this->provinceRepositoryMock
        );
    }

    public function testInvoke()
    {

        $this->provinceRepositoryMock->expects($this->once())
            ->method('save');

        $province = $this->provinceCreator->__invoke(
            'name'
        );

        $this->assertEquals('name', $province->getName());

    }
}
