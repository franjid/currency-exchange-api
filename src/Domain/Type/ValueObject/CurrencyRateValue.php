<?php

namespace Stayforlong\Domain\Type\ValueObject;

class CurrencyRateValue
{
    private const FIELD_ID = 'id';
    private const FIELD_VALUE = 'value';

    private $id;
    private $value;

    public function __construct(string $id, float $value)
    {
        $this->id = $id;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    public function toArray(): array
    {
        return [
            self::FIELD_ID => $this->getId(),
            self::FIELD_VALUE => $this->getValue(),
        ];
    }
}
