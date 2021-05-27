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
        $infoCurrency = $resultCurrencies[$currencyRequestModel->currency] ?? null;
        if (!$infoCurrency) {
            throw new \Exception("Currency \"{$currencyRequestModel->currency}\" not found.");
        }

        $rateCurrency = $currencyRequestModel->rateCurrency;
        $rate = $this->exchange($resultCurrencies, $currencyRequestModel->rateCurrency, (float)$infoCurrency['Value']);

        $rateSum = $currencyRequestModel->rateSum;
        $rateSumResponse = $rateSum > 1
            ? '1' . str_repeat('0', $rateSum - 1)
            : $rateSum;
        $result = round($rate * $rateSumResponse, 4);
        return new CurrencyResponseModel([
            'name' => $infoCurrency['Name'],
            'code' => $currencyRequestModel->currency,
            'result' => $result,
            'rateCurrency' => $rateCurrency,
            'rateSum' => $rateSumResponse,
            'rate' => (string)$rate,
        ]);
    }

    private function exchange(array $allCurrencies, string $rateCurrency, float $baseRate): float
    {
        $rate = $baseRate;
        if ($rateCurrency != 'RUR') {
            if (!isset($allCurrencies[$rateCurrency]['Value'])) {
                throw new \Exception("Currency \"{$rateCurrency}\" not found.");
            }
            $rate = round($baseRate / $allCurrencies[$rateCurrency]['Value'], 4);
        }

        return $rate;
    }
}
