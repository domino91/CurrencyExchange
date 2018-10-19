<?php
namespace CurrencyExchangeService\Itf;

/**
 * Create provider which allowing conversion
 */
interface ProviderFactoryInterface
{

    /**
     * Parameters require to create provider
     * @param array $parameters
     */
    public function setParameters(array $parameters);

    /**
     * create provider
     */
    public function factory(): ProviderInterface;
}
