<?php

namespace Stayforlong\Infrastructure\Interfaces;

interface CurrenciesRepositoryInterface
{
    public function getCurrencies(): array;
    public function getCurrencyExchangeRate(string $currencyId): array;
}
