<?php

namespace Stayforlong\Domain\Interfaces;

use Stayforlong\Domain\Type\Collection\CurrencyCollection;

interface CurrenciesServiceInterface
{
    public function getCurrencies(): CurrencyCollection;
}
