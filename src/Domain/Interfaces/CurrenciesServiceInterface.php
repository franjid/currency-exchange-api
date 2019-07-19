<?php

namespace Stayforlong\Domain\Interfaces;

use Stayforlong\Domain\Type\Collection\CurrencyCollection;
use Stayforlong\Domain\Type\Collection\CurrencyRatesCollection;

interface CurrenciesServiceInterface
{
    public function getCurrencies(): CurrencyCollection;
    public function getCurrenciesExchangeRates(): CurrencyRatesCollection;
}
