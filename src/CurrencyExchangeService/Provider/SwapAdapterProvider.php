<?php
namespace CurrencyExchangeService\Provider;

use CurrencyExchangeService\Itf\ProviderInterface;
use CurrencyExchangeService\Money;
use Swap\Builder;

class SwapAdapterProvider implements ProviderInterface
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
     * @param int $precisionRound number of places to round
     * @param array $rangeArray e.g. ['RUB/PLN' => 0.5]
     */
    public function __construct(int $precisionRound, array $rangeArray)
    {
        $this->precisionRound = $precisionRound;
        $this->rangeArray = $rangeArray;
    }

    /**
     * @inheritdoc
     */
    public function convert(Money $money, string $to): float
    {
        $swap = (new Builder())
            ->add('array', ['range' => $this->rangeArray])
            ->build();

        $rate = $swap->latest(sprintf("%s/%s", $money->getCurrency(), $to));

        $multiplier = $rate->getValue();

        return round($money->getAmount() * $multiplier, $this->precisionRound);
    }
}
