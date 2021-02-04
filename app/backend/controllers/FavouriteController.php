<?php


namespace backend\controllers;


use frontend\models\Favourite;

class FavouriteController extends CommonController
{
    public $modelClass = Favourite::class;

    public $modelUrl = '/favourite';
}