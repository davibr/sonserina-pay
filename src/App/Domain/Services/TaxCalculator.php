<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Clients\TaxManagerClientInterface;

class TaxCalculator
{
    private const DEFAULT_INCREMENT_VALUE = 3.14;

    /**
     * @var TaxManagerClientInterface
     */
    private TaxManagerClientInterface $client;

    /**
     * TaxCalculator constructor.
     * @param TaxManagerClientInterface $client
     */
    public function __construct(TaxManagerClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param float $tax
     * @param float $slytherinTax
     * @return float
     */
    private function getRealTaxValue(float $tax, float $slytherinTax): float
    {
        return 1 + (($slytherinTax + $tax) / 100);
    }

    /**
     * @param float $tax
     * @return float
     */
    public function getSlytherinTax(float $tax): float
    {
        $increment = self::DEFAULT_INCREMENT_VALUE;
        if ($tax > 5) {
            $increment = $this->client->getIncrementValue($tax);
        }
        return $increment;
    }

    /**
     * @param float $amount
     * @param float $tax
     * @return float
     */
    public function calculate(float $amount, float $tax, float $slytherinTax): float
    {
        return $amount * $this->getRealTaxValue($tax, $slytherinTax);
    }
}
