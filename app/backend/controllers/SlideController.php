<?php


namespace backend\controllers;

use frontend\models\Slide;

class SlideController extends CommonController
{
    public $modelClass = Slide::class;

    public $modelUrl = '/slide';
}