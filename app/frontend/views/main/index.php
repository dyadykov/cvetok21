<?php

/* @var $this yii\web\View */

use frontend\models\Slide;
use yii\bootstrap4\Carousel;
use yii\helpers\Html;

$this->title = 'Цветы в Чебоксарах';

echo Html::tag('h3','Главная страница');

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

?>

<br>
- Каталог: Версия поменьше