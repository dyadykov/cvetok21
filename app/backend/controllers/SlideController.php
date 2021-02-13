<?php


namespace backend\controllers;

use common\models\Slide;

class SlideController extends CommonController
{
    public $modelClass = Slide::class;

    public $modelUrl = '/slide';
}