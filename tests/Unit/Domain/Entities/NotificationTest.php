<?php

declare(strict_types=1);

namespace Unit\Domain\Entities;

use App\Domain\Entities\Notification;
use PHPUnit\Framework\TestCase;

class NotificationTest extends TestCase
{
    /**
     * @var Notification
     */
    private Notification $notification;

    protected function setUp(): void
    {
        parent::setUp();
        $this->notification = new Notification('teste@teste.com', 'teste');
    }

    public function testGetEmail(): void
    {
        $this->assertEquals('teste@teste.com', $this->notification->getEmail());
    }

    public function testGetMessage(): void
    {
        $this->assertEquals('teste', $this->notification->getMessage());
    }
}
