<?php


namespace frontend\models;


use yii\db\ActiveRecord;

/**
 * Class Shop
 *
 * @property integer $id ID
 * @property string $title Название
 * @property string $description Описание
 * @property string $lat Долгота
 * @property string $lon Широта
 * @property string $worktime Рабочие часы в будни
 * @property string $worktime_sat Рабочие часы в субботу
 * @property string $worktime_sun Рабочие часы в воскресенье
 * @property string $phone Телефон
 * @property string $address Адрес
 *
 * @package frontend\models
 */
class Shop extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%shop}}';
    }

    public function rules()
    {
        return [
            ['id', 'integer'],
            [['lat', 'lon'], 'number'],
            [['title', 'description', 'worktime', 'worktime_sat', 'worktime_sun', 'phone', 'address'], 'string'],
            [['title', 'lat', 'lon', 'worktime', 'worktime_sat', 'worktime_sun', 'phone', 'address'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'description' => 'Описание',
            'lat' => 'Долгота',
            'lon' => 'Широта',
            'worktime' => 'пн-пт',
            'worktime_sat' => 'сб',
            'worktime_sun' => 'вс',
            'phone' => 'Телефон',
            'address' => 'Адрес',
        ];
    }
}