<?php
namespace app\controllers;

use Exception;
use Yii;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\web\Response;

class JsonController extends Controller
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [

        ]);
    }

    /**
     * @throws Exception
     */
    public function afterAction($action, $result)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $this->setResponseErrorIfAny($result);

        return parent::afterAction($action, $result);
    }

    protected function setResponseError($code)
    {
        Yii::$app->response->statusCode = $code;
    }

    /**
     * @param $response
     * @throws Exception
     */
    protected function setResponseErrorIfAny($response)
    {
        if (is_array($response) && ArrayHelper::keyExists('error', $response)) {
            $this->setResponseError(ArrayHelper::getValue($response, 'code', 400));
        }
    }
}
