<?php

/* @var $this yii\web\View */

$this->title = 'Каталог';
?>
    Каталог
    <br>
    - карточки товаров с пагинацией

<div class="card-columns">
<?php foreach($models as $model): ?>
    <div class="card text-center">
        <img class="card-img-top" src="<?= $model->src ?>" alt="<?= $model->alt ?>">
        <div class="card-body">
            <h5 class="card-title"><?= $model->title ?></h5>
            <p class="card-text"><?= $model->description ?></p>
            <h3><?= $model->price ?> руб.</h3>
            <button type="button" class="btn btn-danger btn-block">Заказать</button>
        </div>
    </div>
<?php endforeach; ?>
</div>