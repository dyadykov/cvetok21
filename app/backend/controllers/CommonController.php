<?php


namespace backend\controllers;


use yii\web\Controller;

abstract class CommonController extends Controller
{
    const PAGE_SIZE = 20;
    const MODEL_SAVED = 'СОХРАНИЛОСЬ';
    const MODEL_NOT_SAVED = 'НЕ СОХРАНИЛОСЬ';
}