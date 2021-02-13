<?php


namespace api\modules\v1\controllers;


use common\models\Product;

class ProductController extends ActiveCommonController
{
    public $modelClass = Product::class;
}