<?php

namespace Stayforlong\Domain\Type\Collection;

use Stayforlong\Domain\Exception\InvalidTypeException;
use Stayforlong\Domain\Type\ValueObject\Currency;
use Stayforlong\Domain\Type\ValueObject\CurrencyRateValue;

class RateCollection
{
    /** @var Currency[] $currencyRates */
    private $currencyRates = [];

    public function __construct(array $currencyRates)
    {
        foreach ($currencyRates as $currencyRate) {
            if (!$currencyRate instanceof CurrencyRateValue) {
                throw new InvalidTypeException();
            }

            $this->currencyRates[] = $currencyRate;
        }
    }

    public function getItems(): array
    {
        return $this->currencyRates;
    }

    public function toArray(): array
    {
        $result = [];

        foreach ($this->currencyRates as $currency) {
            $result[] = $currency->toArray();
        }

        return $result;
    }
}
