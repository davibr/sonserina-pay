<?php

declare(strict_types=1);

namespace Unit\Domain\Entities;

use App\Domain\Entities\Buyer;
use App\Domain\Entities\Seller;
use App\Domain\Entities\Transaction;
use PHPUnit\Framework\TestCase;
use Safe\DateTime;

class TransactionTest extends TestCase
{
    /**
     * @var Transaction
     */
    private Transaction $transaction;

    protected function setUp(): void
    {
        parent::setUp();
        $this->transaction = new Transaction();
    }

    public function testSetGetId(): void
    {
        $this->transaction->setId('teste');
        $this->assertEquals('teste', $this->transaction->getId());
    }

    public function testSetGetBuyer(): void
    {
        $this->transaction->setBuyer(new Buyer(uniqid(""), "teste", "teste@teste.com"));

        $buyer = $this->transaction->getBuyer();
        $this->assertEquals("teste", $buyer->getName());
    }

    public function testSetGetSeller(): void
    {
        $this->transaction->setSeller(new Seller(uniqid(""), "teste", "teste@teste.com"));

        $seller = $this->transaction->getSeller();
        $this->assertEquals("teste", $seller->getName());
    }

    public function testSetGetCreatedDate(): void
    {
        $testDate = new DateTime();

        $this->transaction->setCreatedDate($testDate);
        $this->assertEquals($testDate, $this->transaction->getCreatedDate());
    }

    public function testSetGetInitialAmount(): void
    {
        $this->transaction->setInitialAmount(1847.45);
        $this->assertEquals(1847.45, $this->transaction->getInitialAmount());
    }

    public function testSetGetSellerTax(): void
    {
        $this->transaction->setSellerTax(3.56);
        $this->assertEquals(3.56, $this->transaction->getSellerTax());
    }

    public function testSetGetSlytherinPayTax(): void
    {
        $this->transaction->setSlytherinPayTax(8.89);
        $this->assertEquals(8.89, $this->transaction->getSlytherinPayTax());
    }

    public function testSetGetTotalAmount(): void
    {
        $this->transaction->setTotalAmount(5161.23);
        $this->assertEquals(5161.23, $this->transaction->getTotalAmount());
    }

    public function testSetGetTotalTax(): void
    {
        $this->transaction->setTotalTax(9.96);
        $this->assertEquals(9.96, $this->transaction->getTotalTax());
    }
}
