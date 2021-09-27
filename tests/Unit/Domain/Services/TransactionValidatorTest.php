<?php

declare(strict_types=1);

namespace Unit\Domain\Entities;

use App\Domain\Entities\Transaction;
use App\Domain\Services\TransactionValidator;
use PHPUnit\Framework\TestCase;

class TransactionValidatorTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testCheckPositive(): void
    {
        $transaction = new Transaction();
        $transaction->setInitialAmount(30);

        $transactionValidator = new TransactionValidator();
        $this->assertTrue($transactionValidator->valid($transaction));
    }

    public function testCheckNegative(): void
    {
        $transaction = new Transaction();
        $transaction->setInitialAmount(-30);

        $transactionValidator = new TransactionValidator();
        $this->assertFalse($transactionValidator->valid($transaction));
    }

    public function testCheckZero(): void
    {
        $transaction = new Transaction();
        $transaction->setInitialAmount(0);

        $transactionValidator = new TransactionValidator();
        $this->assertFalse($transactionValidator->valid($transaction));
    }
}
