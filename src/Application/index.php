<?php

use Stayforlong\Domain\Service\CurrenciesService;
use Stayforlong\Infrastructure\Repository\CurrenciesRepositoryCSV;

require __DIR__ . '/../../vendor/autoload.php';

echo 'This index.php entry point is a simple way to show use cases' . PHP_EOL;
echo 'In real world we would use some proper framework for a nice REST API :)' . PHP_EOL . PHP_EOL;

echo '# GET /currencies' . PHP_EOL;

$currenciesService = new CurrenciesService(new CurrenciesRepositoryCSV());
echo json_encode($currenciesService->getCurrencies()->toArray());
