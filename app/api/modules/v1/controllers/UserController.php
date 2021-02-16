<?php


namespace api\modules\v1\controllers;


use common\models\LoginForm;
use common\models\User;
use frontend\models\SignupForm;
use Yii;

class UserController extends CommonController
{
    /** @var array методы используемые без аутентификации */
    public array $noAuth = ['signup', 'login'];

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
        $params['LoginForm'] = Yii::$app->request->post();

        $model = new LoginForm();
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
