<?php
namespace app\models;

use yii\base\Model;

class CurrencyRequestModel extends Model
{
    public string $currency; // Обязательный параметр, код валюты
    public string $rateCurrency = 'RUR'; // Необязательный параметр, код валюты, в которой выведется курс, default RUB (например 1 USD = 70 RUB)
    public int $rateSum = 1; // Необязательный параметр, Сумма первой валюты, default 1. Если sum = 2, то результат будет 10 USD = 700 RUB;

    public function rules()
    {
        return [
            [['currency'], 'required'],
            ['currency', 'string', 'min' => 3, 'max' => 3],
            ['rateCurrency', 'string', 'min' => 3, 'max' => 3],
        ];
    }

}
