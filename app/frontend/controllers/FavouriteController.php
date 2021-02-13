<?php


namespace frontend\controllers;

use common\models\User;
use common\models\Favourite;
use Yii;
use yii\data\Pagination;

class FavouriteController extends CommonController
{
    const PAGE_SIZE = 6;

    public function actionIndex()
    {
        /** @var User $user */
        $user = Yii::$app->user->getIdentity();
        $favourite = $user->getFavourite();

        $pagination = new Pagination(['totalCount' => $favourite->count()]);
        $pagination->setPageSize(self::PAGE_SIZE);

        $favouriteProducts = [];
        /** @var Favourite $favourite */
        foreach ($user->favourite as $favourite) {
            $favouriteProducts[] = $favourite->product;
        }

        return $this->render('index', [
            'favouriteProducts' => $favouriteProducts,
            'pagination' => $pagination,
        ]);
    }
}