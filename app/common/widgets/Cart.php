<?php


namespace common\widgets;


use yii\web\View;

class Cart
{
    /**
     * Отрисовывает в корзине карточки товаров с пагинацией страниц
     *
     * @param \common\models\Cart[] $cart
     * @param View $view
     * @return string выходящая строка HTML кода
     */
    public static function widget(array $cart, View $view): string
    {
        if (empty($cart)) {
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
                var cart_id = $(this).parent().find(".cart_id").val()
                var cart_quantity = $(this).val()
                
                $.ajax({
                    type: "POST",
                    url: "/cart/change-quantity",
                    data: {
                        id: cart_id,
                        quantity: cart_quantity
                    },
                    success: function(msg) {
                      location.reload();
                    }
                });
            })
        ');

        $productCards = '';
        $totalPrice = 0;

        foreach ($cart as $item) {
            $priceForPosition = $item->quantity * $item->product->price;
            $totalPrice += $priceForPosition;
            $viewTotalPrice = "<div class='card mb-3'>
                                <div class='col'>
                                  <h5 class='card-price'>итого: {$totalPrice} руб.</h5>
                                  <a class='btn btn-primary' href='/cart/delete' role='button'>Оформить заказ</a>
                                </div>
                             </div>";

            $productCards .= "<div class='card mb-3'>
                                <div class='row no-gutters'>
                                  <div class='col-md-3'>
                                    <img src='{$item->product->src}' class='card-img' alt='{$item->product->alt}'>
                                  </div>
                                  <div class='col-md-3'>
                                    <div class='card-body'>
                                      <h5 class='card-title'>{$item->product->title}</h5>
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
                                                <input type='text' class='cart_id' value='{$item->id}' hidden>
                                                <input type='text' class='form-control calc' value={$item->quantity}>
                                                <span class='input-group-btn'>
                                                <button class='btn btn-success plus' type='button'>+</button>
                                                </span>
                                            </div>
                                         </div>
                                      </div>
                                      <h5 class='card-price'>{$item->product->price} руб./шт.</h5>
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