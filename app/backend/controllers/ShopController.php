<?php


namespace backend\controllers;


use frontend\models\Shop;

class ShopController extends CommonController
{
    public $modelClass = Shop::class;

    public $modelUrl = '/shop';
}