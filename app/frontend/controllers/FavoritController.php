<?php


namespace frontend\controllers;

use yii\web\Controller;

class FavoritController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}