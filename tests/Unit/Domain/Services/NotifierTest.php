<?php

declare(strict_types=1);

namespace Unit\Domain\Entities;

use App\Domain\Clients\NotifierClientInterface;
use App\Domain\Entities\Buyer;
use App\Domain\Entities\Seller;
use App\Domain\Entities\Transaction;
use App\Domain\Services\Notifier;
use PHPUnit\Framework\TestCase;

class NotifierTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testNotify(): void
    {
        $client = $this->createMock(NotifierClientInterface::class);
        $client->expects($this->exactly(2))
            ->method('notify');

        $transaction = new Transaction();
        $transaction->setSeller(new Seller(uniqid(""), "teste", "teste@teste.com"));
        $transaction->setBuyer(new Buyer(uniqid(""), "teste 2", "teste2@teste.com"));
        $transaction->setTotalAmount(100);

        $notifier = new Notifier($client);
        $notifier->notify($transaction);
    }
}
