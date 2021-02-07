<?php

/**
 * @var $this yii\web\View
 * @var Product[] $products
 */

use common\widgets\Cards;
use frontend\models\Product;
use frontend\models\Slide;
use yii\bootstrap4\Carousel;

$this->title = 'Цвет\'Ок - цветы в Чебоксарах';

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

echo Cards::widget($products, null, $this);
