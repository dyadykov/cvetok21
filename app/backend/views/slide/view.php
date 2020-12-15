<?php

use frontend\models\Slide;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
/** @var Slide $model */

$this->title = 'Добавление нового слайда';

$form = ActiveForm::begin(['id' => 'reset-password-form']);

echo $this->title . '<br>' . '<br>';
echo $form->field($model, 'src')->textInput();
echo $form->field($model, 'alt')->textInput();
echo $form->field($model, 'pos')->textInput();
echo $form->field($model, 'url')->textInput();
echo $form->field($model, 'isActive')->checkbox();

?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end();