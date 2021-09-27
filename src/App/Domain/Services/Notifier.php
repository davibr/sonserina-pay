<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Clients\NotifierClientInterface;
use App\Domain\Entities\Notification;
use App\Domain\Entities\Transaction;

class Notifier
{
    /**
     * @var NotifierClientInterface
     */
    private NotifierClientInterface $client;

    public function __construct(NotifierClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param Transaction $transaction
     * @return Notification
     */
    private function generateBuyerNotification(Transaction $transaction): Notification
    {
        return new Notification(
            $transaction->getBuyer()->getEmail(),
            "Transação de {$transaction->getTotalAmount()} realizada para {$transaction->getSeller()->getName()}."
        );
    }

    /**
     * @param Transaction $transaction
     * @return Notification
     */
    private function generateSellerNotification(Transaction $transaction): Notification
    {
        return new Notification(
            $transaction->getSeller()->getEmail(),
            "Transação de {$transaction->getTotalAmount()} realizada por {$transaction->getBuyer()->getName()}."
        );
    }

    public function notify(Transaction $transaction): void
    {
        $this->client->notify($this->generateBuyerNotification($transaction));
        $this->client->notify($this->generateSellerNotification($transaction));
    }
}
