<?php


namespace frontend\controllers;

use common\models\User;
use Yii;
use yii\data\Pagination;

class FavouriteController extends CommonController
{
    const PAGE_SIZE = 6;

    public function actionIndex()
    {
        /** @var User $user */
        $user = Yii::$app->user->getIdentity();
        $favourite = $user->favourite;

        $pagination = new Pagination(['totalCount' => $favourite->getProducts()->count()]);
        $pagination->setPageSize(self::PAGE_SIZE);

        return $this->render('index', [
            'favouriteProducts' => $favourite->products,
            'pagination' => $pagination,
        ]);
    }
}