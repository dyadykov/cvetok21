<?php


namespace frontend\models;


use yii\db\ActiveRecord;

/**
 * Class Product
 *
 * @property integer $id
 * @property string $src источник картинки
 * @property string $alt описание картинки
 * @property boolean $isActive активный продукт
 * @property string $title название
 * @property string $description описание
 * @property string $price цена
 * @property boolean $isPopular популярный продукт
 *
 * @package frontend\models
 */
class Product extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%product}}';
    }

    public function rules()
    {
        return [
            ['id', 'integer'],
            [['src', 'alt', 'title', 'description', 'price'], 'string'],
            [['isActive', 'isPopular'], 'boolean'],
            [['src', 'alt', 'title', 'description', 'price', 'isActive', 'isPopular'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'src' => 'Источник картинки',
            'alt' => 'Описание картинки',
            'isActive' => 'Активный продукт',
            'title' => 'Название',
            'description' => 'Описание',
            'price' => 'Цена',
            'isPopular' => 'Избранный продукт',
        ];
    }
}