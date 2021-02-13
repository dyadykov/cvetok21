<?php


namespace frontend\controllers;


use common\models\User;
use common\models\Cart;
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

        return $this->render('index', [
            'cartProducts' => $user->cart ?: [],
        ]);
    }

    public function actionChangeQuantity()
    {
        $data = Yii::$app->request->post();
        $id = $data['id'];
        $quantity = $data['quantity'];
        $cart = Cart::findOne($id);
        $oldQuantity = $cart->quantity;
        $cart->quantity = $quantity;
        $cart->save();

        if ($oldQuantity > $quantity) {
            $action = "Убрали";
            $flashType = 'danger';
        } else {
            $action = "Добавили";
            $flashType = 'success';
        }

        $productTitle = $cart->product->title;
        Yii::$app->session->setFlash($flashType, "$action $productTitle");
    }

    public function actionDelete()
    {
        /** @var User $user */
        $user = Yii::$app->user->getIdentity();
        Cart::deleteAll(['user_id' => $user->id]);

        $this->redirect('/main');
    }
}
