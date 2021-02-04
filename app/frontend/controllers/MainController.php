<?php


namespace frontend\controllers;

use frontend\models\Product;
use frontend\models\Slide;
use yii\data\Pagination;

class MainController extends CommonController
{
    const PAGE_SIZE = 3;

    public function actionIndex()
    {
        $slides = Slide::find()->orderBy('pos')->all();
        $productsQuery = Product::find()->where(['isActive' => 1, 'isPopular' => 1]);
        $cloneProductsQuery = clone $productsQuery;

        $pagination = new Pagination(['totalCount' => $cloneProductsQuery->count()]);
        $pagination->setPageSize(self::PAGE_SIZE);
        $products = $productsQuery
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'slides' => $slides,
            'products' => $products,
            'productsPagination' => $pagination,
        ]);
    }
}