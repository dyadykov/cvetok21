<?php


namespace api\modules\v1\controllers;


use common\models\LoginForm;
use common\models\User;
use frontend\models\SignupForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\HttpHeaderAuth;

class UserController extends CommonController
{
    public function behaviors()
    {
        $except = ['signup', 'login'];

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
        ]);
    }

    public function actionSignup()
    {
        $params['SignupForm'] = Yii::$app->request->post();

        $model = new SignupForm();
        if ($model->load($params) && $model->signup()) {
            return 'Thank you for registration.';
        } else {
            return $model->errors;
        }
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        $params['LoginForm'] = Yii::$app->request->post();

        if ($model->load($params) && $model->login()) {
            return User::findByUsername($model->username)->getAuthKey();
        } else {
            return $model->errors;
        }
    }

    public function actionLogout()
    {
        /** @var User $user */
        $user = Yii::$app->user->getIdentity();
        $user->generateAuthKey();
        $user->save();
    }

    protected function verbs()
    {
        return [
            'signup' => ['POST'],
            'login' => ['POST'],
            'logout' => ['GET'],
        ];
    }
}
