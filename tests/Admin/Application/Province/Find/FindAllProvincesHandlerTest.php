<?php

namespace App\Tests\Admin\Application\Province\Find;

use App\Admin\Application\Province\Find\FindAllProvincesHandler;
use App\Admin\Domain\Province\Model\Province;
use App\Admin\Domain\Province\Service\Finder\AllProvincesFinder;
use PHPUnit\Framework\TestCase;

class FindAllProvincesHandlerTest extends TestCase
{
    private FindAllProvincesHandler $handler;

    private AllProvincesFinder $serviceMock;

    public function setUp(): void
    {
        $this->serviceMock = $this->createMock(AllProvincesFinder::class);

        $this->handler = new FindAllProvincesHandler(
            $this->serviceMock
        );
    }

    public function testInvoke()
    {
        $this->serviceMock->expects($this->once())
            ->method('__invoke')
            ->willReturn([]);

        $provinces = $this->handler->__invoke();

        $this->assertIsArray($provinces);
    }

    public function testInvokeWithResults(){
        $this->serviceMock->expects($this->once())
            ->method('__invoke')
            ->willReturn([
                $this->createMock(Province::class),
                $this->createMock(Province::class),
                $this->createMock(Province::class),
            ]);

        $provinces = $this->handler->__invoke();

        $this->assertIsArray($provinces);
        $this->assertCount(3, $provinces);
    }
}
