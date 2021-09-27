<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Entities\CheckService;
use App\Domain\Entities\Transaction;

/**
 * Interface CheckServiceInterface
 * @package App\Domain\Services
 *
 * Interface dos serviços de checagem para ter um método igual em todos para checagem de uma transação
 */
interface CheckServiceInterface
{
    /**
     * @param Transaction $transaction
     * @return bool
     */
    public function check(Transaction $transaction): bool;
}
