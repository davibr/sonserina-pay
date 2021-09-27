<?php

declare(strict_types=1);

namespace Unit\Domain\Entities;

use App\Domain\Entities\Transaction;
use App\Domain\Factories\CheckServiceFactory;
use App\Domain\Services\CheckService1;
use App\Domain\Services\CheckService2;
use App\Domain\Services\FraudChecker;
use PHPUnit\Framework\TestCase;

class FraudCheckerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testCheck(): void
    {
        $fraudChecker = new FraudChecker(new CheckServiceFactory());
        $this->assertTrue($fraudChecker->check(new Transaction()));
    }

    public function testCheckOneFails(): void
    {
        $checkService1 = $this->createMock(CheckService1::class);
        $checkService1->method('check')->willReturn(false);

        $factory = $this->createMock(CheckServiceFactory::class);
        $factory->method('getCheckServices')
            ->willReturn([$checkService1, new CheckService2()]);

        $fraudChecker = new FraudChecker($factory);
        $this->assertTrue($fraudChecker->check(new Transaction()));
    }

    public function testCheckBothFails(): void
    {
        $checkService1 = $this->createMock(CheckService1::class);
        $checkService1->method('check')->willReturn(false);
        $checkService2 = $this->createMock(CheckService2::class);
        $checkService2->method('check')->willReturn(false);

        $factory = $this->createMock(CheckServiceFactory::class);
        $factory->method('getCheckServices')
            ->willReturn([$checkService1, $checkService2]);

        $fraudChecker = new FraudChecker($factory);
        $this->assertFalse($fraudChecker->check(new Transaction()));
    }
}
