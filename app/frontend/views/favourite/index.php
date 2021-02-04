<?php

/**
 * @var $this yii\web\View
 * @var FavouriteProduct[] $favouriteProducts
 * @var Pagination $pagination
 */

use common\widgets\Cards;
use frontend\models\FavouriteProduct;
use yii\data\Pagination;
use yii\helpers\Html;

$this->title = 'Избранное';

echo Html::tag('h3', $this->title);

echo Cards::widget($favouriteProducts, $pagination, $this);
