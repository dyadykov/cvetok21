<?php


namespace api\modules\v1\controllers;


use common\models\Cart;
use common\models\Order;
use Yii;

class CartController extends CommonController
{
    public function actionIndex()
    {
        //отображение товаров корзины
        $userId = Yii::$app->user->getIdentity()->getId();
        return Cart::find()->where(['user_id' => $userId])->all();
    }

    public function actionOrder()
    {
        // оформление товаров
        $userId = Yii::$app->user->getIdentity()->getId();

        $carts = Cart::find()->where(['user_id' => $userId])->asArray()->all();

        $order = new Order(['user_id' => $userId, 'status' => Order::OPEN, 'data' => json_encode($carts)]);

        if ($order->save()) {
            Cart::deleteAll(['user_id' => $userId]);
        };

        return $order;
    }

    public function actionDelete()
    {
        // TODO удаление пределать с GET на DELETE (Postman)
        $userId = Yii::$app->user->getIdentity()->getId();
        return Cart::deleteAll(['user_id' => $userId]);
    }

    public function actionUpdate()
    {
        // изменение количества товара
        $data = Yii::$app->request->getBodyParams();

        $userId = Yii::$app->user->getIdentity()->getId();

        $params = [
            'user_id' => $userId,
            'product_id' => $data['product_id']
        ];

        $cart = Cart::find()->where($params)->one()
            ?: new Cart($params);

        $cart->quantity += $data['quantity'];

        $cart->quantity > 0 ? $cart->save() : $cart->delete();

        return Cart::find()->where(['user_id' => $userId])->all();
    }

    protected function verbs()
    {
        return [
            'index' => ['GET'],
            'order' => ['GET /order'],
            'delete' => ['DELETE'],
            'update' => ['POST'],
        ];
    }
}
