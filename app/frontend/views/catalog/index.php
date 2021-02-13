<?php

/**
 * @var $this yii\web\View
 * @var Product[] $models
 * @var Pagination $pagination
 * @var SearchForm $searchForm
 */

use common\widgets\Cards;
use common\widgets\SearchFilter;
use common\models\Product;
use frontend\models\SearchForm;
use yii\bootstrap4\ActiveForm;
use yii\data\Pagination;

$this->title = 'Каталог';
?>
<h1>
    <?= $this->title ?>
</h1>
<div class="row">
    <div class="col-9">
        <?= Cards::widget($models, $pagination, $this) ?>
    </div>
    <div class="col-3">
        <?php
        echo SearchFilter::widget(ActiveForm::begin(['id' => 'search-form']), $searchForm);
        ActiveForm::end();
        ?>
    </div>
</div>
