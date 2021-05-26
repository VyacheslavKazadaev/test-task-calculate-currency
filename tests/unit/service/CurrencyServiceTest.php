<?php
namespace tests\unit\service;

use app\models\CurrencyRequestModel;
use app\service\CurrencyService;
use Codeception\Specify;

class CurrencyServiceTest extends \Codeception\Test\Unit
{
    use Specify;

    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testCalculate()
    {
        $service = \Yii::$container->get(CurrencyService::class);
        $result = $service->loadAndCalculateCurrency(new CurrencyRequestModel([
            'currency' => 'USD',
		    'rateCurrency' => 'RUB',
		    'rateSum' => 1,
        ]));

    }
}
