<?php

namespace Stayforlong\Tests\Unit\Domain\Service;

use PHPUnit\Framework\TestCase;
use Stayforlong\Domain\Service\CurrenciesService;
use Stayforlong\Domain\Type\Collection\CurrencyCollection;
use Stayforlong\Domain\Type\ValueObject\Currency;
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
}
