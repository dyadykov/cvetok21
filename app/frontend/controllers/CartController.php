<?php


namespace frontend\controllers;

class CartController extends CommonController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}