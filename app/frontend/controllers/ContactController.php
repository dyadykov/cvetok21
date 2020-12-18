<?php


namespace frontend\controllers;

use frontend\models\Shop;

class ContactController extends CommonController
{
    public function actionIndex()
    {
        $shops = Shop::find()->all();

        return $this->render('index',[
            'shops' => $shops,
        ]);
    }
}