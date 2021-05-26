<?php
namespace app\models;

use yii\base\Model;

class CurrencyResponseModel extends Model
{
    public string $name;
    public string $code;
    public string $result;
    public string $rateCurrency;
    public string $rateSum;
    public string $rate;
}
