<?php

namespace Stayforlong\Tests\Unit\Domain\Service;

use PHPUnit\Framework\TestCase;
use Stayforlong\Domain\Service\CurrenciesService;
use Stayforlong\Domain\Type\Collection\CurrencyCollection;
use Stayforlong\Domain\Type\Collection\CurrencyRatesCollection;
use Stayforlong\Domain\Type\Collection\RateCollection;
use Stayforlong\Domain\Type\ValueObject\Currency;
use Stayforlong\Domain\Type\ValueObject\CurrencyRates;
use Stayforlong\Domain\Type\ValueObject\CurrencyRateValue;
use Stayforlong\Infrastructure\Interfaces\CurrenciesRepositoryInterface;

class CurrenciesServiceTest extends TestCase
{
    private $currenciesRepositoryProphecy;

    /** @var $currenciesService CurrenciesService*/
    private $currenciesService;

    public function setUp ()
    {
        $this->currenciesRepositoryProphecy = $this->prophesize(CurrenciesRepositoryInterface::class);
        /** @var $currenciesRepository CurrenciesRepositoryInterface */
        $currenciesRepository = $this->currenciesRepositoryProphecy->reveal();

        $this->currenciesService = new CurrenciesService($currenciesRepository);
    }

    public function testGetCurrencies(): void
    {
        $this->currenciesRepositoryProphecy->getCurrencies()
            ->shouldBeCalled()
            ->willReturn([
                [
                    'id' => 'euro',
                    'symbol' => '€'
                ],
                [
                    'id' => 'dollar',
                    'symbol' => '$'
                ],
            ])
        ;

        $currencyEuro = new Currency('euro', '€');
        $currencyDollar = new Currency('dollar', '$');
        $expectedCurrencyCollection = new CurrencyCollection([
            $currencyEuro,
            $currencyDollar
        ]);

        $currencyCollection = $this->currenciesService->getCurrencies();

        $this->assertEquals($expectedCurrencyCollection, $currencyCollection);
    }

    public function testGetCurrenciesExchangeRates(): void
    {
        $this->currenciesRepositoryProphecy->getCurrencies()
            ->shouldBeCalled()
            ->willReturn([
                [
                    'id' => 'euro',
                    'symbol' => '€'
                ]
            ])
        ;

        $this->currenciesRepositoryProphecy->getCurrencyExchangeRate('euro')
            ->shouldBeCalled()
            ->willReturn([
                [
                    'id' => 'dollar',
                    'value' => 1
                ],
                [
                    'id' => 'pound',
                    'value' => 2
                ],
            ])
        ;

        $euroDollarRateValue = new CurrencyRateValue('dollar', 1);
        $euroPoundRateValue = new CurrencyRateValue('pound', 2);
        $rateCollection = new RateCollection([$euroDollarRateValue, $euroPoundRateValue]);
        $currencyRates = new CurrencyRates('euro', $rateCollection);
        $expectedCurrencyRatesCollection = new CurrencyRatesCollection([$currencyRates]);

        $currencyRatesCollection = $this->currenciesService->getCurrenciesExchangeRates();

        $this->assertEquals($expectedCurrencyRatesCollection, $currencyRatesCollection);
    }
}
