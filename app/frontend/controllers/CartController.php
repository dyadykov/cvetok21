<?php


namespace frontend\controllers;


use common\models\User;
use frontend\models\CartProduct;
use Yii;
use yii\filters\AccessControl;

class CartController extends CommonController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'change-quantity', 'delete'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        /** @var User $user */
        $user = Yii::$app->user->getIdentity();
        $cart = $user->cart;

        $cartProducts = $cart->cartProducts ?: [];

        return $this->render('index', [
            'cartProducts' => $cartProducts,
        ]);
    }

    public function actionChangeQuantity()
    {
        $data = Yii::$app->request->post();
        $id = $data['id'];
        $quantity = $data['quantity'];
        $cartProduct = CartProduct::findOne($id);
        $oldQuantity = $cartProduct->quantity;

        if ($quantity > 0) {
            $cartProduct->quantity = $quantity;
            $cartProduct->save();
        } else {
            $cartProduct->delete();
        }

        if ($oldQuantity > $quantity) {
            $action = "Убрали";
            $flashType = 'danger';
        } else {
            $action = "Добавили";
            $flashType = 'success';
        }

        $productTitle = $cartProduct->product->title;
        Yii::$app->session->setFlash($flashType, "$action $productTitle");
    }

    public function actionDelete()
    {
        Yii::$app->user->getIdentity()->cart->unlinkAll('products', true);

        $this->redirect('/main');
    }
}
