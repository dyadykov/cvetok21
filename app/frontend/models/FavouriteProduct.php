<?php


namespace frontend\models;


use yii\db\ActiveRecord;

/**
 * Class Product
 *
 * @property integer $id ID
 * @property integer $favourite_id id корзины
 * @property integer $product_id id товара
 * @property Product $product
 *
 * @package frontend\models
 */
class FavouriteProduct extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%favourite_product}}';
    }

    public function rules()
    {
        return [
            [['id', 'favourite_id', 'product_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'favourite_id' => 'id корзины',
            'product_id' => 'id товара',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
}