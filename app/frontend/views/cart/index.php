<?php

/**
 * @var $this yii\web\View
 * @var \frontend\models\CartProduct[] $cartProducts
 */

use common\widgets\Cart;
use yii\helpers\Html;

$this->title = 'Корзина';

echo Html::tag('h3', 'Корзина покупок');

echo Cart::widget($cartProducts, $this) ?>