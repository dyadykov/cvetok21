<?php


namespace backend\controllers;


use common\models\Favourite;

class FavouriteController extends CommonController
{
    public $modelClass = Favourite::class;

    public $modelUrl = '/favourite';
}