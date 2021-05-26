<?php
namespace app\service;

class CurrencyGetterClientMock extends CurrencyGetterClient
{
    public function requestForGetCurrency(): array
    {
        return [
            'USD' => [
                'Name'  => 'Доллар США',
                'Value' => 70,
            ],
        ];
    }
}
