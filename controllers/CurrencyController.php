<?php
namespace app\controllers;

use app\models\CurrencyRequestModel;
use app\service\CurrencyService;
use Yii;
use yii\filters\VerbFilter;

class CurrencyController extends JsonController
{
    private CurrencyService $currencyService;

    public function __construct($id, $module, CurrencyService $currencyService, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->currencyService = $currencyService;
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'currency' => ['get'],
                ],
            ],
        ]);
    }

    public function actionIndex()
    {
        $requestModel = new CurrencyRequestModel(Yii::$app->request->queryParams);

    }
}
