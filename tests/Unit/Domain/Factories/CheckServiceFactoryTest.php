<?php

declare(strict_types=1);

namespace Unit\Domain\Entities;

use App\Domain\Entities\CheckService;
use App\Domain\Factories\CheckServiceFactory;
use App\Domain\Services\CheckService1;
use PHPUnit\Framework\TestCase;

class CheckServiceFactoryTest extends TestCase
{
    private CheckServiceFactory $checkServiceFactory;

    protected function setUp(): void
    {
        parent::setUp();
        $this->checkServiceFactory = new CheckServiceFactory();
    }

    public function testGenerateEntities(): void
    {
        $checkServices = $this->checkServiceFactory->generateEntities();

        $this->assertIsArray($checkServices);
        $this->assertCount(2, $checkServices);
        foreach ($checkServices as $checkService) {
            $this->assertInstanceOf(CheckService::class, $checkService);
        }
    }

    public function testGetCheckServices(): void
    {
        $entities = $this->checkServiceFactory->generateEntities();
        $checkServices = $this->checkServiceFactory->getCheckServices();

        $this->assertIsArray($checkServices);
        $this->assertCount(2, $checkServices);
        for ($i = 0; $i < count($entities); $i++) {
            $this->assertInstanceOf($entities[$i]->getServiceClass(), $checkServices[$i]);
        }
    }

    public function testGetServiceByEntityCorrect(): void
    {
        $entity = new CheckService(1, 'Teste', 1, 'App\Domain\Services\CheckService1');
        $this->assertInstanceOf(CheckService1::class, $this->checkServiceFactory->getServiceByEntity($entity));
    }

    public function testGetServiceByEntityClassInexistent(): void
    {
        $entity = new CheckService(1, 'Teste', 1, 'App\Domain\Services\CheckService3');
        $this->assertNull($this->checkServiceFactory->getServiceByEntity($entity));
    }

    public function testGetServiceByEntityClassNotService(): void
    {
        $entity = new CheckService(1, 'Teste', 1, 'App\Domain\Services\TransactionValidator');
        $this->assertNull($this->checkServiceFactory->getServiceByEntity($entity));
    }
}
