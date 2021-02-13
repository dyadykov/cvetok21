<?php


namespace frontend\controllers;


use common\models\User;
use common\models\Cart;
use common\models\Favourite;
use common\models\Product;
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
                ->andFilterWhere(['isPopular' => $searchForm->isPopular ?: null])
                ->andFilterWhere(['title' => $searchForm->title])
                ->andFilterWhere(['like', 'description', $searchForm->description]);
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

    public function actionAddToCart()
    {
        $productId = Yii::$app->request->post()['product_id'];
        $userId = Yii::$app->user->getIdentity()->id;

        $cart = Cart::find()->where(['user_id' => $userId, 'product_id' => $productId])->one()
            ?: new Cart(['user_id' => $userId, 'product_id' => $productId]);

        $cart->quantity += 1;
        $cart->save();

        Yii::$app->session->setFlash('success', 'Добавлено в коризну');
    }

    public function actionAddToFav()
    {
        $productId = Yii::$app->request->post()['product_id'];
        $userId = Yii::$app->user->getIdentity()->id;

        $favourite = new Favourite(['user_id' => $userId, 'product_id' => $productId]);
        $favourite->save();

        Yii::$app->session->setFlash('success', 'Добавлено в избранное');
    }

    public function actionDropFromFav()
    {
        $productId = Yii::$app->request->post()['product_id'];
        $userId = Yii::$app->user->getIdentity()->id;

        $favourite = Favourite::find()->where(['user_id' => $userId, 'product_id' => $productId])->one();
        $favourite->delete();

        Yii::$app->session->setFlash('danger', 'Удалено из избранного');
    }
}
