<?php


namespace frontend\models;


use yii\db\ActiveRecord;

/**
 * Class Product
 *
 * @property integer $id ID
 * @property integer $cart_id id корзины
 * @property integer $product_id id товара
 * @property integer $quantity количество товара
 * @property Product $product
 *
 * @package frontend\models
 */
class CartProduct extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%cart_product}}';
    }

    public function rules()
    {
        return [
            [['id', 'cart_id', 'product_id', 'quantity'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cart_id' => 'id корзины',
            'product_id' => 'id товара',
            'quantity' => 'количество товара',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
}