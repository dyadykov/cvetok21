<?php

/* @var $this yii\web\View */

use common\widgets\Shops;
use common\models\Shop;
use yii\helpers\Html;

$this->title = 'Контакты';

echo Html::tag('h3', 'Связаться с нами можете по контактам магазинов');

/** @var Shop[] $shops */
echo Shops::widget(['models' => $shops]);
