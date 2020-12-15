<?php


namespace frontend\controllers;

use frontend\models\Slide;
use yii\web\Controller;

class MainController extends Controller
{
    public function actionIndex()
    {
        $slides = Slide::find()->orderBy('pos')->all();

        return $this->render('index', [
            'slides' => $slides,
        ]);
    }
}