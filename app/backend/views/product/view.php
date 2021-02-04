<?php

use frontend\models\Product;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/** @var Product $model */

$this->title = 'Добавление нового продукта';

$form = ActiveForm::begin(['id' => 'reset-password-form']);

echo $this->title . '<br>' . '<br>';
echo $form->field($model, 'src')->textInput();
echo $form->field($model, 'alt')->textInput();
echo $form->field($model, 'description')->textInput();
echo $form->field($model, 'title')->textInput();
echo $form->field($model, 'isActive')->checkbox();
echo $form->field($model, 'isPopular')->checkbox();
echo $form->field($model, 'price')->textInput(['type' => 'number']);

?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end();