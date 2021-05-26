<?php
namespace app\service;

use app\models\CurrencyRequestModel;
use app\models\CurrencyResponseModel;

class CurrencyService extends Service
{
    private CurrencyGetterClient $client;

    public function __construct(CurrencyGetterClient $client, $config = [])
    {
        parent::__construct($config);
        $this->client = $client;
    }

    /**
     * @param CurrencyRequestModel $currencyRequestModel
     * @return CurrencyResponseModel
     * @throws \Exception
     */
    public function loadAndCalculateCurrency(CurrencyRequestModel $currencyRequestModel): CurrencyResponseModel
    {
        $resultCurrencies = $this->client->requestForGetCurrency();
        $infoCurrency = $resultCurrencies['Valute'][$currencyRequestModel->currency] ?? null;
        if (!$infoCurrency) {
            throw new \Exception("Currency \"{$currencyRequestModel->currency}\" not found.");
        }

        $rateSum = $currencyRequestModel->rateSum;
        $rateSumResponse = $rateSum > 1
            ? '1' . str_repeat('0', $rateSum - 1)
            : $rateSum;
        $result = round($infoCurrency['Value'] * $rateSumResponse, 4);
        return new CurrencyResponseModel([
            'name' => $infoCurrency['Name'],
            'code' => $currencyRequestModel->currency,
            'result' => $result,
            'rateCurrency' => $currencyRequestModel->rateCurrency,
            'rateSum' => $rateSumResponse, // количество долларов на размен
            'rate' => (string)$infoCurrency['Value'],
        ]);
    }
}
