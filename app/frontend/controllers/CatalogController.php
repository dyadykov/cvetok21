<?php


namespace frontend\controllers;

use frontend\models\Product;

class CatalogController extends CommonController
{
    public function actionIndex()
    {
        $models = Product::find()->where(['isActive' => 1])->all();

        return $this->render('index', [
            'models' => $models,
        ]);
    }
}