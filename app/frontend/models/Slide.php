<?php


namespace frontend\models;


use yii\db\ActiveRecord;

/**
 * Class Slide
 *
 * @property integer $id
 * @property integer $pos
 * @property string $src
 * @property string $url
 * @property string $alt
 * @property boolean $isActive
 *
 * @package frontend\models
 */
class Slide extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%slide}}';
    }

    public function rules()
    {
        // TODO изучить rules в документации движка в интернете
        return [
            [['id', 'pos'], 'integer', 'message' => 'Поле "{attribute}" должно быть числом'],
            [['src', 'url', 'alt'], 'string'],
            ['isActive', 'boolean'],
            [['pos', 'src', 'url', 'alt'], 'required', 'message' => 'Поле "{attribute}" не может быть пустым.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'src' => 'Ссылка на картинку',
            'alt' => 'Описание картинки',
            'pos' => 'Порядковый номер',
            'url' => 'Ссылка по картинке',
            'isActive' => 'Активно',
        ];
    }
}