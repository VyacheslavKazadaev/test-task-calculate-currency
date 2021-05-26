<?php
namespace app\controllers;

use app\models\CurrencyRequestModel;
use app\service\CurrencyService;
use Yii;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;

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
        try {
            $requestModel = new CurrencyRequestModel(Yii::$app->request->queryParams);
            if (!$requestModel->validate()) {
                throw new \Exception('Bad params.');
            }
            $response = $this->currencyService->loadAndCalculateCurrency($requestModel);
        } catch (\Exception $e) {
            Yii::error($e->getMessage());
            return ['error' => 'Bad request'];
        }
        return $response->toArray();
    }
}
