<?php

declare(strict_types=1);

namespace App\Domain\Entities;

class Seller
{
    /**
     * @var string
     */
    private string $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $email;

    public function __construct(string $id, string $name, string $email)
    {
        $this->id = $id;
        $this->name= $name;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
