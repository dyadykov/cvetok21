<?php


namespace backend\controllers;


use common\models\Product;

class ProductController extends CommonController
{
    public $modelClass = Product::class;

    public $modelUrl = '/product';
}