<?php
namespace CurrencyExchangeService\Itf;

/**
 * Converts the currency
 */
interface ProviderInterface
{
    /**
     * Convert money to currency type of $to
     * @param \CurrencyExchangeService\Money $money original
     * @param string $to destination currency code
     * @return float destination value
     */
    public function convert(\CurrencyExchangeService\Money $money, string $to): float;
}
