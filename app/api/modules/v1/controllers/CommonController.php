<?php


namespace api\modules\v1\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\HttpHeaderAuth;
use yii\filters\Cors;
use yii\rest\Controller;
use yii\web\Response;

abstract class CommonController extends Controller
{
    public function behaviors()
    {
        return [
            'authenticator' => [
                'class' => HttpHeaderAuth::class,
                'except' => $this->noAuth,
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => $this->noAuth,
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'corsFilter' => [
                'class' => Cors::class,
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Allow-Headers' => ['*'],
                ]
            ],
        ];
    }

    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }
}