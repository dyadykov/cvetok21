<?php


namespace api\modules\v1\controllers;


abstract class CommonController extends \yii\rest\Controller
{
    public function beforeAction($action)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }
}