<?php


namespace frontend\models;


use common\models\User;
use yii\db\ActiveRecord;

/**
 * Class Product
 *
 * @property integer $id
 * @property integer $user_id id пользователя
 * @property User $user пользователь
 * @property Product[] $products пользователь
 * @property CartProduct[] $cartProducts продукты из корзины
 *
 * @package frontend\models
 */
class Cart extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%cart}}';
    }

    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer', 'message' => 'Поле "{attribute}" должно быть числом'],
            ['products', 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'id пользователя',
            'username' => 'id пользователя',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getCartProducts()
    {
        return $this->hasMany(CartProduct::class, ['cart_id' => 'id']);
    }

    public function getProducts()
    {
        return $this->hasMany(Product::class, ['id' => 'product_id'])
            ->via('cartProducts');
    }

    public function setProducts($ids = [])
    {
        $this->save();
        $this->unlinkAll('products', true);
        foreach ($ids as $id) {
            $this->link('products', Product::findOne($id));
        }
    }

    public function afterDelete()
    {
        $this->unlinkAll('products', true);
        parent::afterDelete();
    }
}