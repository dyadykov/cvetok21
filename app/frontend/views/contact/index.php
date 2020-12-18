<?php

/* @var $this yii\web\View */

use common\widgets\Shops;
use frontend\models\Shop;
use yii\helpers\Html;

$this->title = 'Контакты';

echo Html::tag('h3', 'Связаться с нами можете по контактам магазинов');

// TODO 3 добавить шапку
/** @var Shop[] $shops */
echo Shops::widget(['models' => $shops]);
