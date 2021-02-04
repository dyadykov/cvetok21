<?php
/* @var $this yii\web\View */

/* @var ActiveDataProvider $dataProvider */

use frontend\models\Favourite;
use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

$this->title = 'Избранное';

echo Html::a('Добавить продукт вручную', '/favourite/view', ['class' => 'btn btn-success']);

echo Html::tag('h3', 'Избранное');

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'user' => [
            'label' => 'Имя пользователя',
            'value' => function ($model) {
                /** @var Favourite $model */
                return $model->user->username;
            }
        ],
        [
            'label' => 'Товары',
            'format' => 'html',
            'value' => function ($model) {
                /** @var Favourite $model */
                $productLinks = [];
                foreach ($model->products as $product) {
                    $productLinks[] = "<a href='/product/view?id=$product->id'>$product->title</a>";
                }
                return implode(", ", $productLinks) ?: "пусто";
            }
        ],
        'buttons' => [
            'label' => 'Кнопки',
            'format' => 'html',
            'value' => function ($model) {
                return Html::a('Редактировать', '/favourite/view?id=' . $model->id)
                    . '<br>'
                    . Html::a('Удалить', '/favourite/delete?id=' . $model->id);
            }
        ],
    ]
]);
