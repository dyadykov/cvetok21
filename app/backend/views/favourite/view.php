<?php

use common\models\User;
use common\models\Product;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;

/** @var Product $model */

$this->title = 'Добавление нового продукта в корзину';

$form = ActiveForm::begin(['id' => 'reset-password-form']);

echo $this->title . '<br>' . '<br>';
echo $form->field($model, 'id')->textInput();
echo $form->field($model, 'user_id')->label('Пользователь')->widget(Select2::class, [
    'data' => ArrayHelper::map(User::find()->asArray()->all(), 'id', 'username'),
    'options' => ['placeholder' => 'Выберите пользователя'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);
echo $form->field($model, 'product_id')->label('Продукты')->widget(Select2::class, [
    'attribute' => 'product_id',
    'data' => ArrayHelper::map(Product::find()->asArray()->all(), 'id', 'title'),
    'options' => ['placeholder' => 'Выберите продукты'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);

?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end();
