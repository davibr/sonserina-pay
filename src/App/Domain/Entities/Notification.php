<?php

declare(strict_types=1);

namespace App\Domain\Entities;

class Notification
{
    /**
     * @var string
     */
    private string $email;

    /**
     * @var string
     */
    private string $message;

    public function __construct(string $email, string $message)
    {
        $this->email = $email;
        $this->message = $message;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
