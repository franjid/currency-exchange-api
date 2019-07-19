<?php

namespace Stayforlong\Infrastructure\Repository;

use Stayforlong\Infrastructure\Interfaces\CurrenciesRepositoryInterface;

class CurrenciesRepositoryCSV implements CurrenciesRepositoryInterface
{
    private const CURRENCIES_CSV = __DIR__ . '/../../../data/currencies.csv';

    public function getCurrencies(): array
    {
        $currencies = [];

        if (($csv = fopen(self::CURRENCIES_CSV, 'rb')) !== false) {
            while (($data = fgetcsv($csv, 10)) !== false) {
                $currencies[] = [
                    'id' => $data[0],
                    'symbol' => $data[1],
                ];
            }

            fclose($csv);
        }

        return $currencies;
    }
}
