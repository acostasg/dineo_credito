<?php

namespace App\Tests\Admin\Domain\City\Service\Create;

use App\Admin\Domain\City\Repository\CityRepository;
use App\Admin\Domain\City\Service\Create\CityCreator;
use App\Admin\Domain\Province\Model\Province;
use PHPUnit\Framework\TestCase;

class CityCreatorTest extends TestCase
{
    private CityCreator $cityCreator;

    private CityRepository $cityRepositoryMock;

    protected function setUp(): void
    {
        $this->cityRepositoryMock = $this->createMock(CityRepository::class);

        $this->cityCreator = new CityCreator(
            $this->cityRepositoryMock
        );
    }

    public function testInvoke()
    {

        $this->cityRepositoryMock->expects($this->once())
            ->method('save');

        $city = $this->cityCreator->__invoke(
            'name',
            Province::create('province')
        );

        $this->assertEquals('name', $city->getName());
        $this->assertEquals('province', $city->getProvince()->getName());

    }
}
