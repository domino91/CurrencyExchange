<?php
namespace CurrencyExchangeService;

use CurrencyExchangeService\Itf\CurrencyExchangeServiceInterface;
use CurrencyExchangeService\Itf\ProviderFactoryInterface;
use CurrencyExchangeService\Itf\ProviderInterface;

class CurrencyExchangeService implements CurrencyExchangeServiceInterface
{

    /**
     * Converts the currency
     * @var ProviderInterface
     */
    private $providerConvert;

    public function __construct(ProviderFactoryInterface $providerConvertFactory)
    {
        $this->providerConvert = $providerConvertFactory->factory();
    }

    /**
     * @inheritdoc
     */
    public function convert(float $value, string $from, string $to): float
    {
        $money = new Money($value, $from);
        return $this->providerConvert->convert($money, $to);
    }
}
