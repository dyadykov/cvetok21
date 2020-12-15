<?php
/* @var $this yii\web\View */

/* @var ActiveDataProvider $dataProvider */

use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

$this->title = 'Продукты';

echo Html::a('Создать продукт', '/product/view', ['class' => 'btn btn-success']);

echo Html::tag('h3', 'Продукты');

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'src',
        'alt',
        'isActive',
        'title',
        'description',
        'price',
        'buttons' => [
            'label' => 'Кнопки',
            'format' => 'html',
            'value' => function ($model) {
                return Html::a('Редактировать', '/product/view?id=' . $model->id)
                    . '<br>'
                    . Html::a('Удалить', '/product/delete?id=' . $model->id);
            }
        ],
    ]
]);