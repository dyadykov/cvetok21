<?php


namespace api\modules\v1\controllers;


use common\models\Shop;

class ShopController extends ActiveCommonController
{
    public $modelClass = Shop::class;
}