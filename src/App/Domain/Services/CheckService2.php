<?php


namespace App\Domain\Services;


use App\Domain\Entities\Transaction;

class CheckService2 implements CheckServiceInterface
{

    /**
     * @inheritDoc
     */
    public function check(Transaction $transaction): bool
    {
        // Aqui teríamos a implementação da chamada da API/SDK de terceiros
        return true;
    }
}