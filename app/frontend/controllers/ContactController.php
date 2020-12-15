<?php


namespace frontend\controllers;

class ContactController extends CommonController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}