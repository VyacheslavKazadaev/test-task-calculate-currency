<?php

use Codeception\Util\HttpCode;

class CurrencyControllerCest
{
    public function tryToIndex(ApiTester $I)
    {
        $I->sendGet('currency/index', [
            'currency' => 'USD',
            'rateCurrency' => 'RUR',
            'rateSum' => '2',
        ]);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'name' => 'string',
            'code' => 'string',
            'result' => 'string',
            'rateCurrency' => 'string',
            'rateSum' => 'string',
            'rate' => 'string',
        ]);
    }
}
