<?php

namespace Stayforlong\Domain\Type\Collection;

use Stayforlong\Domain\Exception\InvalidTypeException;
use Stayforlong\Domain\Type\ValueObject\Currency;

class CurrencyCollection
{
    /** @var Currency[] $currencies */
    private $currencies = [];

    public function __construct(array $currencies)
    {
        foreach ($currencies as $currency) {
            if (!$currency instanceof Currency) {
                throw new InvalidTypeException();
            }

            $this->currencies[] = $currency;
        }
    }

    public function getCurrencies(): array
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
