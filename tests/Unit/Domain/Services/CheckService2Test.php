<?php

declare(strict_types=1);

namespace Unit\Domain\Entities;

use App\Domain\Entities\Transaction;
use App\Domain\Services\CheckService2;
use PHPUnit\Framework\TestCase;

class CheckService2Test extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testCheck(): void
    {
        $checkService = new CheckService2();
        $this->assertTrue($checkService->check(new Transaction()));
    }
}
