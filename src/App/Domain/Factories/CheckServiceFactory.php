<?php

namespace App\Domain\Factories;

use App\Domain\Entities\CheckService;
use App\Domain\Services\CheckServiceInterface;

/**
 * Class CheckServiceFactory
 * @package App\Domain\Factories
 *
 * Factory para criar os serviços de checagem de terceiros
 */
class CheckServiceFactory
{
    /**
     * @return CheckService[]
     *
     * Função para retornar as entidades.
     */
    public function generateEntities(): array
    {
        return [
            new CheckService(1, 'Serviço 1', 1, 'App\Domain\Services\CheckService1'),
            new CheckService(2, 'Serviço 2', 2, 'App\Domain\Services\CheckService2')
        ];
    }

    /**
     * @param CheckService $entity
     * @return CheckServiceInterface|null
     * Retorna o serviço de checagem à partir da entidade
     */
    public function getServiceByEntity(CheckService $entity): ?CheckServiceInterface
    {
        $className = $entity->getServiceClass();
        if (class_exists($className))
        {
            $class = new $className;
            if ($class instanceof CheckServiceInterface)
            {
                return $class;
            }
        }
        return null;
    }

    /**
     * @return CheckServiceInterface[]
     * Gera os serviços na ordem de prioridade
     */
    public function getCheckServices(): array
    {
        // Aqui eu poderia carregar os CheckServices do banco e retornar os serviços na ordem de prioridade
        // Mas como não estamos trabalhando com o banco irei gerar 2 registros
        $entities = $this->generateEntities();

        $services = [];
        foreach ($entities as $entity) {
            $services[] = $this->getServiceByEntity($entity);
        }
        return $services;
    }
}