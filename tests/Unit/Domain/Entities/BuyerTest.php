<?php

declare(strict_types=1);

namespace Unit\Domain\Entities;

use App\Domain\Entities\Buyer;
use PHPUnit\Framework\TestCase;

class BuyerTest extends TestCase
{
    /**
     * @var Buyer
     */
    private Buyer $buyer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->buyer = new Buyer(uniqid(""), 'teste', 'teste@teste.com');
    }

    public function testGetName(): void
    {
        $this->assertEquals('teste', $this->buyer->getName());
    }

    public function testGetEmail(): void
    {
        $this->assertEquals('teste@teste.com', $this->buyer->getEmail());
    }
}
