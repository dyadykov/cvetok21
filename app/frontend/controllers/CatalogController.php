<?php


namespace frontend\controllers;

use frontend\models\Product;
use yii\web\Controller;

class CatalogController extends Controller
{
    public function actionIndex()
    {
        $models = Product::find()->where(['isActive' => 1])->all();

        return $this->render('index', [
            'models' => $models,
        ]);
    }
}