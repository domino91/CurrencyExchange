<?php
namespace CurrencyExchangeService;

class Money
{

    /**
     * Value money
     * @var float
     */
    private $amount;

    /**
     * Code currency
     * @var string
     */
    private $currency;

    public function __construct(float $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * value of currency
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * code of currency
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }
}
