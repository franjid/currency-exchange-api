<?php

namespace Stayforlong\Infrastructure\Repository;

use Stayforlong\Infrastructure\Interfaces\CurrenciesRepositoryInterface;

class CurrenciesRepositoryCSV implements CurrenciesRepositoryInterface
{
    private const CURRENCIES_CSV = __DIR__ . '/../../../data/currencies.csv';
    private const CURRENCIES_RATES_CSV = __DIR__ . '/../../../data/currencies_rates.csv';

    public function getCurrencies(): array
    {
        $currencies = [];

        if (($csv = fopen(self::CURRENCIES_CSV, 'rb')) !== false) {
            while (($data = fgetcsv($csv)) !== false) {
                $currencies[] = [
                    'id' => $data[0],
                    'symbol' => $data[1],
                ];
            }

            fclose($csv);
        }

        return $currencies;
    }

    public function getCurrencyExchangeRate(string $currencyId): array
    {
        $currencyExchangeRates = [];

        if (($csv = fopen(self::CURRENCIES_RATES_CSV, 'rb')) !== false) {
            while (($data = fgetcsv($csv)) !== false) {
                if ($data[0] !== $currencyId) {
                    continue;
                }

                $dataLength = count($data);

                for ($i = 1; $i < $dataLength; $i += 2) {
                    $currencyExchangeRates[] = [
                        'id' => $data[$i],
                        'value' => $data[$i + 1],
                    ];
                }
            }

            fclose($csv);
        }

        return $currencyExchangeRates;
    }
}
