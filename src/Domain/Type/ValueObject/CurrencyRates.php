<?php

namespace Stayforlong\Domain\Type\ValueObject;

use Stayforlong\Domain\Type\Collection\RateCollection;

class CurrencyRates
{
    private const FIELD_ID = 'id';
    private const FIELD_RATES = 'rates';

    private $id;
    private $rates;

    public function __construct(string $id, RateCollection $rates)
    {
        $this->id = $id;
        $this->rates = $rates;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return RateCollection
     */
    public function getRates(): RateCollection
    {
        return $this->rates;
    }

    public function toArray(): array
    {
        return [
            self::FIELD_ID => $this->getId(),
            self::FIELD_RATES => $this->getRates()->toArray(),
        ];
    }
}
