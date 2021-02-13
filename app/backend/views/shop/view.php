<?php

use common\models\Shop;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/** @var Shop $model */

$this->title = 'Добавление нового магазина';

$form = ActiveForm::begin(['id' => 'reset-password-form']);

echo $this->title . '<br>' . '<br>';

?>

<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'title')->textInput() ?>
        <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'lat')->textInput(['type' => "number", 'step' => "0.000001"]) ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model, 'lon')->textInput(['type' => "number", 'step' => "0.000001"]) ?>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'phone')->textInput() ?>
        <?= $form->field($model, 'address')->textInput() ?>
        <?= Html::label('Рабочие часы:') ?>
        <div class="row">
            <div class="col-sm-4">
                <?= $form->field($model, 'worktime')->textInput() ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'worktime_sat')->textInput() ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'worktime_sun')->textInput() ?>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end();