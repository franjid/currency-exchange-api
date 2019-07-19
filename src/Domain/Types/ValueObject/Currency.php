<?php

namespace Stayforlong\Domain\Types\ValueObject;

class Currency
{
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
}
