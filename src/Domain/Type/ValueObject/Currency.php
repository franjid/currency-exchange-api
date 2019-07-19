<?php

namespace Stayforlong\Domain\Type\ValueObject;

class Currency
{
    private const FIELD_ID = 'id';
    private const FIELD_SYMBOL = 'symbol';

    private $id;
    private $symbol;

    public function __construct(string $id, string $symbol)
    {
        $this->id = $id;
        $this->symbol = $symbol;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function toArray(): array
    {
        return [
            self::FIELD_ID => $this->getId(),
            self::FIELD_SYMBOL => $this->getSymbol(),
        ];
    }
}
