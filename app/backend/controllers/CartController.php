<?php


namespace backend\controllers;


use frontend\models\Cart;

class CartController extends CommonController
{
    public $modelClass = Cart::class;

    public $modelUrl = '/cart';
}