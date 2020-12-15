<?php
/* @var $this yii\web\View */
/* @var ActiveDataProvider $dataProvider */

use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

$this->title = 'Слайды';

echo Html::a('Создать слайд', '/slide/view', ['class' => 'btn btn-success']);

echo Html::tag('h3','Таблица слайдера');

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'src',
        'alt',
        'buttons' => [
            'label' => 'Кнопки',
            'format' => 'html',
            'value' => function ($model) {
                return Html::a('Редактировать', '/slide/view?id=' . $model->id)
                    . '<br>'
                    . Html::a('Удалить', '/slide/delete?id=' . $model->id);
            }
        ],
    ]
]);
