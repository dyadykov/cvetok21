<?php


namespace frontend\controllers;

use common\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class MainController extends Controller
{
    public function actionIndex()
    {
         return $this->render('index');
    }
}