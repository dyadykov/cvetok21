<?php


namespace common\widgets;


use Throwable;
use Yii;
use yii\base\Model;
use yii\bootstrap4\LinkPager;
use yii\data\Pagination;
use yii\web\View;

class Cards
{
    const ADD_TO_CART = "addToCart";

    /**
     * Отрисовывает карточки товаров с пагинацией страниц
     *
     * @param Model[] $models массив моделей с свойствами src, alt, title, descrittion, price
     * @param Pagination $pagination
     * @param View $view
     * @return string выходящая строка HTML кода
     * @throws Throwable
     */
    public static function widget(array $models, Pagination $pagination, View $view): string
    {
        $view->registerJs('
            $(".' . self::ADD_TO_CART . '").click(function(){
                var product_id = $(this).parent().find(".product_id").val();
                $.ajax({
                    type: "POST",
                    url: "/catalog/add-to-cart",
                    data: {
                        product_id: product_id
                    },
                    success: function (response) {
                        location.reload()
                    }
                })
            })
        ');

        $cards = '';
        foreach ($models as $model) {
            if (Yii::$app->user->isGuest) {
                $button = '<a class="btn btn-danger btn-block" href="/site/signup">Добавить в корзину</a>';
            } else {
                $cartProductsIds = Yii::$app->user->getIdentity()->cart->getCartProducts()->select('product_id')->column();
                $button = !in_array($model->id, $cartProductsIds)
                    ? '<button type = "button" class="btn btn-danger btn-block ' . self::ADD_TO_CART . '">Добавить в корзину</button>'
                    : '<a class="btn btn-danger btn-block" href="/cart">Товар в корзине</a>';
            }

            $card = '<div class="card text-center">
                        <img class="card-img-top" src = "' . $model->src . '" alt = "' . $model->alt . '">
                            <div class="card-body">
                                <h5 class="card-title"> ' . $model->title . '</h5>
                                <p class="card-text"> ' . $model->description . '</p>
                                <h3> ' . $model->price . ' руб. </h3>
                                <input type="text" class="product_id" value="' . $model->id . '" hidden>
                                ' . $button . '
                            </div>
                    </div>';
            $cards .= $card;
        }

        return '<div class="card-columns">' . $cards . '</div>' . LinkPager::widget(['pagination' => $pagination]);
    }
}
