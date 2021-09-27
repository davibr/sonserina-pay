<?php

declare(strict_types=1);

namespace Unit\Domain\Entities;

use App\Domain\Entities\CheckService;
use PHPUnit\Framework\TestCase;

class CheckServiceTest extends TestCase
{
    /**
     * @var CheckService
     */
    private CheckService $checkService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->checkService = new CheckService(1, 'Teste', 1, 'CheckService1');
    }

    public function testSetGetId(): void
    {
        $this->checkService->setId(2);
        $this->assertEquals(2, $this->checkService->getId());
    }

    public function testSetGetName(): void
    {
        $this->checkService->setName('Teste 2');
        $this->assertEquals('Teste 2', $this->checkService->getName());
    }

    public function testSetGetPriority(): void
    {
        $this->checkService->setPriority(2);
        $this->assertEquals(2, $this->checkService->getPriority());
    }

    public function testSetGetServiceClass(): void
    {
        $this->checkService->setServiceClass('CheckService2');
        $this->assertEquals('CheckService2', $this->checkService->getServiceClass());
    }
}
