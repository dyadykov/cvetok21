<?php


namespace api\modules\v1\controllers;


use yii\rest\ActiveController;

abstract class ActiveCommonController extends ActiveController
{
    public function beforeAction($action)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }
}