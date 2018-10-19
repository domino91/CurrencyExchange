<?php
namespace CurrencyExchangeService\Itf;

/**
 * Interface main service Currency Exchange, provides the main currency conversion API
 */
interface CurrencyExchangeServiceInterface
{

    /**
     * Convert original to destination value
     *
     * @param float $value original value currency to conversion
     * @param string $from original currency code
     * @param string $to destination currency code
     * @return float destination value
     */
    function convert(float $value, string $from, string $to): float;
}
