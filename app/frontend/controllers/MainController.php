<?php


namespace frontend\controllers;

use frontend\models\Slide;

class MainController extends CommonController
{
    public function actionIndex()
    {
        $slides = Slide::find()->orderBy('pos')->all();

        return $this->render('index', [
            'slides' => $slides,
        ]);
    }
}