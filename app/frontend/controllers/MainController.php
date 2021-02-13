<?php


namespace frontend\controllers;

use common\models\Product;
use common\models\Slide;
use yii\data\Pagination;

class MainController extends CommonController
{
    const PAGE_SIZE = 3;

    public function actionIndex()
    {
        $slides = Slide::find()->orderBy('pos')->all();
        $products = Product::find()->where(['isActive' => 1, 'isPopular' => 1])
            ->limit(self::PAGE_SIZE)
            ->all();

        return $this->render('index', [
            'slides' => $slides,
            'products' => $products,
        ]);
    }
}