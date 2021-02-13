<?php


namespace common\models;


use yii\db\ActiveRecord;

/**
 * Class Product
 *
 * @property integer $id ID
 * @property integer $user_id id пользователя
 * @property integer $product_id id товара
 * @property Product $product
 *
 * @package frontend\models
 */
class Favourite extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%favourite}}';
    }

    public function rules()
    {
        return [
            [['id', 'user_id', 'product_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'id пользователя',
            'product_id' => 'id товара',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}