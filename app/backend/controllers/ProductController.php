<?php


namespace backend\controllers;


use frontend\models\Product;

class ProductController extends CommonController
{
    public $modelClass = Product::class;

    public $modelUrl = '/product';
}