<?php


namespace frontend\controllers;

use frontend\models\Product;
use frontend\models\SearchForm;
use Yii;
use yii\data\Pagination;

class CatalogController extends CommonController
{
    const PAGE_SIZE = 6;

    public function actionIndex()
    {
        $activeQuery = Product::find()->where(['isActive' => 1])->orderBy('id');

        $searchForm = new SearchForm();
        $searchData = Yii::$app->request->post();
        if ($searchForm->load($searchData) && $searchForm->validate()) {
            $activeQuery
                ->andFilterWhere(['>=', 'price', $searchForm->priceMin])
                ->andFilterWhere(['<=', 'price', $searchForm->priceMax])
                ->andFilterWhere(['isFavourite' => $searchForm->isFavourite ?: null])
                ->andFilterWhere(['title' => $searchForm->title])
                ->andFilterWhere(['like', 'description', $searchForm->description])
;
        } elseif (!empty($searchData)) {
            Yii::$app->session->setFlash('error', "Фильтр не сработал");
        }

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
            'searchForm' => $searchForm,
        ]);
    }
}