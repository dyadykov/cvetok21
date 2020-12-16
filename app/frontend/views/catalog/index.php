<?php

/**
 * @var $this yii\web\View
 * @var Product[] $models
 * @var Pagination $pagination
 */

use common\widgets\Cards;
use frontend\models\Product;
use yii\data\Pagination;

$this->title = 'Каталог';
?>
    Каталог
    <br>
    - карточки товаров с пагинацией

<?= Cards::widget(['models' => $models, 'pagination' => $pagination]) ?>