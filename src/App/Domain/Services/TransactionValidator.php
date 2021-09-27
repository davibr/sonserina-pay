<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Entities\Transaction;
use App\Domain\Factories\CheckServiceFactory;
use Mockery\Exception;

class TransactionValidator
{
    public function valid(Transaction $transaction): bool
    {
        return $this->checkInitialAmount($transaction->getInitialAmount());
    }

    private function checkInitialAmount(float $amount): bool
    {
        return $amount > 0;
    }
}
