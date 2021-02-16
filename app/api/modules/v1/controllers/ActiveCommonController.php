<?php


namespace api\modules\v1\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\HttpHeaderAuth;
use yii\filters\Cors;
use yii\rest\ActiveController;
use yii\web\Response;

abstract class ActiveCommonController extends ActiveController
{
    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        $except = ['index', 'view'];

        return array_merge(parent::behaviors(), [
            'authenticator' => [
                'class' => HttpHeaderAuth::class,
                'except' => $except,
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => $except,
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
        ]);
    }

    protected function verbs()
    {
        return [
            'index'  => ['get'],
            'view'   => ['get'],
            'create' => ['post'],
            'update' => ['put'],
            'delete' => ['delete'],
        ];
    }
}