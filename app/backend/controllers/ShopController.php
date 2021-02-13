<?php


namespace backend\controllers;


use common\models\Shop;

class ShopController extends CommonController
{
    public $modelClass = Shop::class;

    public $modelUrl = '/shop';
}