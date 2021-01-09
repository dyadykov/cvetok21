<?php


namespace common\widgets;


use Exception;
use frontend\models\CartProduct;
use yii\web\View;

class Cart
{
    /**
     * Отрисовывает в корзине карточки товаров с пагинацией страниц
     *
     * @return string выходящая строка HTML кода
     * @throws Exception
     */
    public static function widget(array $cartProducts, View $view): string
    {
        if (empty($cartProducts)) {
            \Yii::$app->session->setFlash('danger', 'Корзина пуста');
            return false;
        }

        $view->registerJs('
            $(".minus").click(function(){
                var input = $(this).parent().parent().find(".calc")
                input.attr("value", parseInt(input.val())-1).trigger("change");
            });
            $(".plus").click(function(){
                var input = $(this).parent().parent().find(".calc")
                input.attr("value", parseInt(input.val())+1).trigger("change");
            }); 
        ');


        $view->registerJs('
            $(".calc").change(function() {
                var cart_product_id = $(this).parent().find(".cart_product_id").val()
                var cart_product_quantity = $(this).val()
                
                $.ajax({
                    type: "POST",
                    url: "/cart/change-quantity",
                    data: {
                        id: cart_product_id,
                        quantity: cart_product_quantity
                    },
                    success: function(msg) {
                      location.reload();
                    }
                });
            })
        ');

        $productCards = '';
        $totalPrice = 0;

        /** @var CartProduct $cartProduct */
        foreach ($cartProducts as $cartProduct) {
            $priceForPosition = $cartProduct->quantity * $cartProduct->product->price;
            $totalPrice += $priceForPosition;
            $viewTotalPrice = "<div class='card mb-3'>
                                <div class='col'>
                                  <h5 class='card-price'>итого: {$totalPrice} руб.</h5>
                                  <a class='btn btn-primary' href='/cart/delete?id={$cartProduct->cart_id}' role='button'>Оформить заказ</a>
                                </div>
                             </div>";

            $productCards .= "<div class='card mb-3'>
                                <div class='row no-gutters'>
                                  <div class='col-md-3'>
                                    <img src='{$cartProduct->product->src}' class='card-img' alt='{$cartProduct->product->alt}'>
                                  </div>
                                  <div class='col-md-3'>
                                    <div class='card-body'>
                                      <h5 class='card-title'>{$cartProduct->product->title}</h5>
                                    </div>
                                  </div>
                                  <div class='col-md-4'>
                                    <div class='card-body'>
                                      <div class='row'>
                                         <div class='col-lg-6 col-lg-offset-3'>
                                            <div class='input-group'>
                                                <span class='input-group-btn'>
                                                <button class='btn btn-danger minus' type='button'>-</button>
                                                </span>
                                                <input type='text' class='cart_product_id' value='{$cartProduct->id}' hidden>
                                                <input type='text' class='form-control calc' value={$cartProduct->quantity}>
                                                <span class='input-group-btn'>
                                                <button class='btn btn-success plus' type='button'>+</button>
                                                </span>
                                            </div>
                                         </div>
                                      </div>
                                      <h5 class='card-price'>{$cartProduct->product->price} руб./шт.</h5>
                                    </div>
                                  </div>
                                  <div class='col-md-2'>
                                    <div class='card-body'>
                                      <h5 class='card-price'>{$priceForPosition} руб.</h5>
                                    </div>
                                  </div>
                                </div>
                             </div>";
        }

        $products = "<div class='col-9'>$productCards</div>";
        $total = "<div class='col-3'>$viewTotalPrice</div>";

        return "<div class='row'>" . $products . $total . "</div>";
    }
}