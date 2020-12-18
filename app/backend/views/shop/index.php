<?php
/* @var $this yii\web\View */
/* @var ActiveDataProvider $dataProvider */

use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

$this->title = 'Магазины';

echo Html::a('Добавить магазины', '/shop/view', ['class' => 'btn btn-success']);

echo Html::tag('h3','Таблица магазинов');

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'title',
        'description',
        'lat',
        'lon',
        'worktime',
        'worktime_sat',
        'worktime_sun',
        'phone',
        'address',
        'buttons' => [
            'label' => 'Кнопки',
            'format' => 'html',
            'value' => function ($model) {
                return Html::a('Редактировать', '/shop/view?id=' . $model->id)
                    . '<br>'
                    . Html::a('Удалить', '/shop/delete?id=' . $model->id);
            }
        ],
    ]
]);
