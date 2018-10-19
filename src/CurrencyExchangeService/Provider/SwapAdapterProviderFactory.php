<?php
namespace CurrencyExchangeService\Provider;

use CurrencyExchangeService\Itf\ProviderFactoryInterface;
use CurrencyExchangeService\Itf\ProviderInterface;
use InvalidArgumentException;

class SwapAdapterProviderFactory implements ProviderFactoryInterface
{

    /**
     * number of places to round
     * @var int
     */
    private $precisionRound;

    /**
     * Value multiplier e.g. ['RUB/PLN' => 0.5]
     * @var array
     */
    private $rangeArray = array();

    /**
     * @inheritdoc
     */
    public function factory(): ProviderInterface
    {
        return new SwapAdapterProvider($this->precisionRound, $this->rangeArray);
    }

    /**
     * @inheritdoc
     */
    public function setParameters(array $parameters)
    {
        if (!array_key_exists('precisionRound', $parameters)) {
            throw new InvalidArgumentException("No has precisionRound");
        }

        if (!array_key_exists('rangeArray', $parameters)) {
            throw new InvalidArgumentException("No has rangeArray");
        }

        $this->precisionRound = $parameters['precisionRound'];
        $this->rangeArray = $parameters['rangeArray'];
    }
}
