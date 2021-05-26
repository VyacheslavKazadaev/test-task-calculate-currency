<?php
namespace tests\unit\service;

use app\models\CurrencyRequestModel;
use app\models\CurrencyResponseModel;
use app\service\CurrencyService;
use Codeception\Specify;

class CurrencyServiceTest extends \Codeception\Test\Unit
{
    use Specify;

    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testLoadAndCalculateCurrency()
    {
        $service = \Yii::$container->get(CurrencyService::class);
        $result = $service->loadAndCalculateCurrency(new CurrencyRequestModel([
            'currency' => 'USD',
		    'rateCurrency' => 'RUR',
		    'rateSum' => 2,
        ]));

        $this->tester->assertInstanceOf(CurrencyResponseModel::class, $result);
        $this->tester->assertEquals([
            'name' => 'Доллар США',
	        'code' => 'USD',
	        'result' => '700',
	        'rateCurrency' => 'RUR',
	        'rateSum' => '10', // количество долларов на размен
	        'rate' => '70',
        ], $result->toArray());
    }
}
