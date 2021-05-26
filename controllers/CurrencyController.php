<?php
namespace app\controllers;

use yii\filters\VerbFilter;

class CurrencyController extends JsonController
{
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
    }
}
