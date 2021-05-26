<?php
namespace app\service;

use app\models\CurrencyRequestModel;

class CurrencyService extends Service
{
    private CurrencyGetterClient $client;

    public function __construct(CurrencyGetterClient $client, $config = [])
    {
        parent::__construct($config);
        $this->client = $client;
    }

    public function loadAndCalculateCurrency(CurrencyRequestModel $currencyRequestModel)
    {
        $resultCurrencies = $this->client->requestForGetCurrency();


    }
}
