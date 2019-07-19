<?php

namespace Stayforlong\Domain\Service;

use Stayforlong\Domain\Interfaces\CurrenciesServiceInterface;
use Stayforlong\Domain\Type\Collection\CurrencyRatesCollection;
use Stayforlong\Domain\Type\Collection\RateCollection;
use Stayforlong\Domain\Type\ValueObject\Currency;
use Stayforlong\Domain\Type\Collection\CurrencyCollection;
use Stayforlong\Domain\Type\ValueObject\CurrencyRates;
use Stayforlong\Domain\Type\ValueObject\CurrencyRateValue;
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

    public function getCurrenciesExchangeRates(): CurrencyRatesCollection
    {
        $currencies = $this->getCurrencies()->getItems();
        $currencyRatesCollectionArray = [];

        /** @var $currency Currency */
        foreach ($currencies as $currency) {
            $currencyId = $currency->getId();
            $currencyRatesRaw = $this->currencyRepository->getCurrencyExchangeRate($currencyId);
            $currencyRates = [];

            foreach ($currencyRatesRaw as $currencyRateRaw) {
                $currencyRates[] = new CurrencyRateValue($currencyRateRaw['id'], $currencyRateRaw['value']);
            }

            $rateCollection = new RateCollection($currencyRates);
            $currencyRates = new CurrencyRates($currencyId, $rateCollection);
            $currencyRatesCollectionArray[] = $currencyRates;
        }

        return new CurrencyRatesCollection($currencyRatesCollectionArray);
    }
}
