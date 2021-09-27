<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use DateTime;

/**
 * Class CheckService
 * @package App\Domain\Entities
 *
 * Classe para representar um serviço de checagem, pensei em termos cadastrados os serviços em um cms
 * para que se possa gerenciar através de uma ferramenta gerencial a prioridade de checagem
 */
class CheckService
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var int
     */
    private int $priority;

    /**
     * @var string
     */
    private string $serviceClass;

    public function __construct(
        int $id = null,
        string $name = null,
        int $priority = null,
        string $serviceClass = null
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->priority = $priority;
        $this->serviceClass = $serviceClass;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority(int $priority): void
    {
        $this->priority = $priority;
    }

    /**
     * @return string
     */
    public function getServiceClass(): string
    {
        return $this->serviceClass;
    }

    /**
     * @param string $serviceClass
     */
    public function setServiceClass(string $serviceClass): void
    {
        $this->serviceClass = $serviceClass;
    }
}
