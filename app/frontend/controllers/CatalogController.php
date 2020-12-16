<?php


namespace frontend\controllers;

use frontend\models\Product;
use yii\data\Pagination;

class CatalogController extends CommonController
{
    const PAGE_SIZE = 6;

    public function actionIndex()
    {
        $activeQuery = Product::find()->where(['isActive' => 1]);
        $cloneActiveQuery = clone $activeQuery;
        $pagination = new Pagination(['totalCount' => $cloneActiveQuery->count()]);
        $pagination->setPageSize(self::PAGE_SIZE);
        $models = $activeQuery
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'models' => $models,
            'pagination' => $pagination,
        ]);
    }
}