<?php


use kartik\switchinput\SwitchInput;
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

echo '<label class="control-label">Status</label>';
echo SwitchInput::widget([
    'name' => 'status_3',
    'bsVersion' => 4,
    'type' => SwitchInput::RADIO,
    'items' => [
        ['label' => 1, 'value' => 1,],
        ['label' => 2, 'value' => 2,],
        ['label' => 3, 'value' => 3,],
        ['label' => 4, 'value' => 4,],
        ['label' => 5, 'value' => 5,],
        ['label' => 6, 'value' => 6,],
        ['label' => 7, 'value' => 7,],
    ]
]);


?>
Главная страница
<br>
- Слайдер: Наши рекомендации
<br>
- Каталог: Версия поменьше