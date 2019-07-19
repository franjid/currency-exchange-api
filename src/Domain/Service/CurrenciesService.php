<?php

namespace Stayforlong\Domain\Service;

use Stayforlong\Domain\Interfaces\CurrenciesServiceInterface;
use Stayforlong\Domain\Type\ValueObject\Currency;
use Stayforlong\Domain\Type\Collection\CurrencyCollection;
use Stayforlong\Infrastructure\Interfaces\CurrenciesRepositoryInterface;

class CurrenciesService implements CurrenciesServiceInterface
{
    private $currencyRepository;

    public function __construct(CurrenciesRepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function getCurrencies(): CurrencyCollection
    {
        $currenciesRaw = $this->currencyRepository->getCurrencies();
        $currencies = [];

        foreach ($currenciesRaw as $currencyRaw) {
            $currencies[] = new Currency($currencyRaw['id'], $currencyRaw['symbol']);
        }

        return new CurrencyCollection($currencies);
    }
}
