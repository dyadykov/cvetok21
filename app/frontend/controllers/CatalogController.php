<?php


namespace frontend\controllers;


use common\models\User;
use frontend\models\CartProduct;
use frontend\models\FavouriteProduct;
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
        $cart = Yii::$app->user->getIdentity()->cart;

        $cartProduct = CartProduct::find()->where(['cart_id' => $cart->id, 'product_id' => $productId])->one()
            ?: new CartProduct(['cart_id' => $cart->id, 'product_id' => $productId]);

        $cartProduct->quantity += 1;
        $cartProduct->save();

        Yii::$app->session->setFlash('success', 'Добавлено в коризну');
    }

    public function actionAddToFav()
    {
        $productId = Yii::$app->request->post()['product_id'];
        /** @var User $user */
        $user = Yii::$app->user->getIdentity();
        $favourite = $user->favourite;

        $favouriteProduct = new FavouriteProduct(['favourite_id' => $favourite->id, 'product_id' => $productId]);

        $favouriteProduct->save();

        Yii::$app->session->setFlash('success', 'Добавлено в избранное');
    }

    public function actionDropFromFav()
    {
        $productId = Yii::$app->request->post()['product_id'];

        /** @var User $user */
        $user = Yii::$app->user->getIdentity();
        $favourite = $user->favourite;

        $favouriteProduct = FavouriteProduct::find()->where(['favourite_id' => $favourite->id, 'product_id' => $productId])->one();

        $favouriteProduct->delete();

        Yii::$app->session->setFlash('danger', 'Удалено из избранного');
    }
}
