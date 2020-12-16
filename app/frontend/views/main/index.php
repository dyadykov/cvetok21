<?php

/**
 * @var $this yii\web\View
 * @var Product[] $products
 * @var Pagination $productsPagination
 */

use common\widgets\Cards;
use frontend\models\Product;
use frontend\models\Slide;
use yii\bootstrap4\Carousel;
use yii\data\Pagination;
use yii\helpers\Html;

$this->title = 'Цветы в Чебоксарах';

echo Html::tag('h3', 'Главная страница');

/** @var Slide[] $slides */
$mappedSlides = array_map(function ($slide) {
    return [
        'content' => '<img src="' . $slide->src . '"/>',
        'caption' => '<h3>"' . $slide->alt . '"</h3>',
    ];
}, $slides);

echo Carousel::widget([
    'items' => $mappedSlides
]);

echo Cards::widget(['models' => $products, 'pagination' => $productsPagination]);