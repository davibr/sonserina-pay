<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Entities\Transaction;
use App\Domain\Factories\CheckServiceFactory;
use Mockery\Exception;

class FraudChecker
{
    /**
     * @var CheckServiceFactory
     */
    private CheckServiceFactory $checkServiceFactory;

    public function __construct(CheckServiceFactory $checkServiceFactory)
    {
        $this->checkServiceFactory = $checkServiceFactory;
    }

    public function check(Transaction $transaction): bool
    {
        foreach ($this->checkServiceFactory->getCheckServices() as $service) {
            if ($service->check($transaction)) {
                return true;
            }
        }
        return false;
    }
}
