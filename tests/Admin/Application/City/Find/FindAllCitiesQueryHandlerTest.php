<?php

namespace App\Tests\Admin\Application\City\Find;

use App\Admin\Application\City\Find\FindAllCitiesQueryHandler;
use App\Admin\Domain\City\Model\City;
use App\Admin\Domain\City\Service\Finder\AllCitiesFinder;
use PHPUnit\Framework\TestCase;

class FindAllCitiesQueryHandlerTest extends TestCase
{

    private FindAllCitiesQueryHandler $handler;

    private AllCitiesFinder $serviceMock;

    public function setUp(): void
    {
        $this->serviceMock = $this->createMock(AllCitiesFinder::class);

        $this->handler = new FindAllCitiesQueryHandler(
            $this->serviceMock
        );
    }

    public function testInvoke()
    {
        $this->serviceMock->expects($this->once())
            ->method('__invoke')
            ->willReturn([]);

        $cities = $this->handler->__invoke();

        $this->assertIsArray($cities);
    }

    public function testInvokeWithResults()
    {
        $this->serviceMock->expects($this->once())
            ->method('__invoke')
            ->willReturn([
                $this->createMock(City::class),
                $this->createMock(City::class),
                $this->createMock(City::class),
            ]);

        $cities = $this->handler->__invoke();

        $this->assertIsArray($cities);
        $this->assertCount(3, $cities);
    }

}
