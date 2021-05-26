<?php
namespace app\service;

class CurrencyGetterClientMock extends CurrencyGetterClient
{
    public function requestForGetCurrency(): array
    {
        return [
            'Valute' => [
                'USD' => [
                    'ID'       => "R01235",
                    'NumCode'  => "840",
                    'CharCode' => "USD",
                    'Nominal'  => 1,
                    'Name'     => "Доллар США",
                    'Value'    => 73.4737,
                    'Previous' => 73.3963
                ],
            ],
        ];
    }
}
