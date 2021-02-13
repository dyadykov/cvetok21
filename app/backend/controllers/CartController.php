<?php


namespace backend\controllers;


use common\models\Cart;

class CartController extends CommonController
{
    public $modelClass = Cart::class;

    public $modelUrl = '/cart';
}