<?php

declare(strict_types=1);

namespace Unit\Domain\Entities;

use App\Domain\Entities\Seller;
use PHPUnit\Framework\TestCase;

class SellerTest extends TestCase
{
    /**
     * @var Seller
     */
    private Seller $seller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seller = new Seller(uniqid(""), 'teste', 'teste@teste.com');
    }

    public function testGetName(): void
    {
        $this->assertEquals('teste', $this->seller->getName());
    }

    public function testGetEmail(): void
    {
        $this->assertEquals('teste@teste.com', $this->seller->getEmail());
    }
}
