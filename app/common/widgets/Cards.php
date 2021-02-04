<?php


namespace common\widgets;


use common\models\User;
use rmrevin\yii\fontawesome\FAR;
use rmrevin\yii\fontawesome\FontAwesome;
use Throwable;
use Yii;
use yii\base\Model;
use yii\bootstrap4\LinkPager;
use yii\data\Pagination;
use yii\web\View;

class Cards
{
    const ADD_TO_CART = "addToCart";
    const ADD_TO_FAV = "addToFav";
    const DROP_FROM_FAV = "dropFromFav";

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
            
            $(".' . self::ADD_TO_FAV . '").click(function(){
                var product_id = $(this).parent().parent().find(".product_id").val();
                $.ajax({
                    type: "POST",
                    url: "/catalog/add-to-fav",
                    data: {
                        product_id: product_id
                    },
                    success: function (response) {
                        location.reload()
                    }
                })
            })
            
            $(".' . self::DROP_FROM_FAV . '").click(function(){
                var product_id = $(this).parent().parent().find(".product_id").val();
                $.ajax({
                    type: "POST",
                    url: "/catalog/drop-from-fav",
                    data: {
                        product_id: product_id
                    },
                    success: function (response) {
                        location.reload()
                    }
                })
            })
        ');

        $view->registerCss("
            .fa-heart, .fa-heart-broken {
                color: pink !important;
            }
        ");

        $cards = '';
        $favouriteIcon = '';
        foreach ($models as $model) {
            if (Yii::$app->user->isGuest) {
                $button = '<a class="btn btn-danger btn-block" href="/site/signup">Добавить в корзину</a>' .
                    '<br>
                    <a class="btn btn-success btn-block" href="/site/signup">Добавить в избранное</a>';
            } else {
                /** @var User $user */
                $user = Yii::$app->user->getIdentity();
                $cartProductsIds = $user->cart->getCartProducts()->select('product_id')->column();
                $button = !in_array($model->id, $cartProductsIds)
                    ? '<button type = "button" class="btn btn-danger btn-block ' . self::ADD_TO_CART . '">Добавить в корзину</button>'
                    : '<a class="btn btn-outline-danger btn-block" href="/cart">Товар в корзине</a>';


                $favouriteProductsIds = $user->favourite->getFavouriteProducts()->select('product_id')->column();
                $favouriteIcon = !in_array($model->id, $favouriteProductsIds)
                    ? FAR::icon('heart', ['class' => [self::ADD_TO_FAV, 'btn p-0 m-2']])->size(FontAwesome::SIZE_2X)
                    : FontAwesome::icon('heart', ['class' => [self::DROP_FROM_FAV, 'btn p-0 m-2']])->size(FontAwesome::SIZE_2X);
            }

            $card = '<div class="card text-center">
                        <img class="card-img-top" src = "' . $model->src . '" alt = "' . $model->alt . '">
                            <div style="position: absolute; top: 0; right: 0">' . $favouriteIcon . '</div>
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
