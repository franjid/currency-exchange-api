<?php

namespace Stayforlong\Domain\Type\Collection;

use Stayforlong\Domain\Exception\InvalidTypeException;
use Stayforlong\Domain\Type\ValueObject\Currency;
use Stayforlong\Domain\Type\ValueObject\CurrencyRates;

class CurrencyRatesCollection
{
    /** @var Currency[] $currencies */
    private $currencies = [];

    public function __construct(array $currencies)
    {
        foreach ($currencies as $currency) {
            if (!$currency instanceof CurrencyRates) {
                throw new InvalidTypeException();
            }

            $this->currencies[] = $currency;
        }
    }

    public function getItems(): array
    {
        return $this->currencies;
    }

    public function toArray(): array
    {
        $result = [];

        foreach ($this->currencies as $currency) {
            $result[] = $currency->toArray();
        }

        return $result;
    }
}
