<?php
namespace app\service;

class CurrencyGetterClientMock extends CurrencyGetterClient
{
    public function requestForGetCurrency(): array
    {
        return [
            'Valute' => [
                'USD' => [
                    'Name'  => 'Доллар США',
                    'Value' => 70,
                ],
            ],
        ];
    }
}
