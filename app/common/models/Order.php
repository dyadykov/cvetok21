<?php


namespace common\models;


use yii\db\ActiveRecord;

/**
 * Class Product
 *
 * @property integer $id ID
 * @property integer $user_id id пользователя
 * @property integer $status статус заказа
 * @property string $data данные заказа
 * @property User $user пользователь
 *
 * @package frontend\models
 */
class Order extends ActiveRecord
{
    const OPEN = 1;
    const PROCESSING = 2;
    const SUCCESS = 3;
    const ERROR = 0;

    public static function tableName()
    {
        return '{{%order}}';
    }

    public function rules()
    {
        return [
            [['id', 'user_id', 'status'], 'integer'],
            ['data', 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'id пользователя',
            'status' => 'статус заказа',
            'data' => 'данные заказа',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
