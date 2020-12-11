<?php


use yii\data\ActiveDataProvider;
use yii\grid\GridView;

/* @var $this yii\web\View */
$this->title = 'Цветы в Чебоксарах';

/* @var $activeDataProvider ActiveDataProvider */

echo GridView::widget([
    'dataProvider' => $activeDataProvider,
    'columns' => [
        [
            'attribute' => 'id',
            'value' => function ($model) {
                return $model->id * 25;
            }
        ],
        'username',
        'authKey',
        'email',
    ],
]);

?>
Главная страница
<br>
- Слайдер: Наши рекомендации
<br>
- Каталог: Версия поменьше