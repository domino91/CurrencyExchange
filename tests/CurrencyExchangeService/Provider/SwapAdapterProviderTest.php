<?php
namespace Tests\CurrencyExchangeService\Provider;

use CurrencyExchangeService\Money;
use CurrencyExchangeService\Provider\SwapAdapterProvider;
use PHPUnit\Framework\TestCase;

class SwapAdapterProviderTest extends TestCase
{

    /**
     * @dataProvider convertProvider
     */
    public function testConvert(Money $money, string $toCurrency, float $expected)
    {
        $rangeArray = [
            'RUB/PLN' => 0.0953541261,
            'PLN/RUB' => 10.487223169
        ];
        $swapAdapterProvider = new SwapAdapterProvider(2, $rangeArray);
        
        $result = $swapAdapterProvider->convert($money, $toCurrency);
        $this->assertEquals($expected, $result);
    }

    public function convertProvider()
    {
        return
            [
                [new Money(123.12, 'RUB'), 'PLN', 11.74],
                [new Money(123, 'RUB'), 'PLN', 11.73],
                [new Money(11.74, 'PLN'), 'RUB', 123.12],
                [new Money(0, 'PLN'), 'RUB', 0],
        ];
    }
    
    /**
     * @expectedException \Exchanger\Exception\UnsupportedExchangeQueryException
     */
    public function testNotSupportedCurrency()
    {
        $rangeArray = [];
        $swapAdapterProvider = new SwapAdapterProvider(2, $rangeArray);
        
        $result = $swapAdapterProvider->convert(new Money(2, 'RUB/PLN'), 'PLN/RUB');
    }
}
