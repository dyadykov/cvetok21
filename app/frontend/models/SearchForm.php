<?php

namespace frontend\models;
/**
 * Class SearchForm Фильтр продуктов
 */
class SearchForm extends \yii\base\Model
{
    const TITLE_NOT_CHOSEN = 'Выберите название';


    /** @var boolean $isFavourite Выбрать из избранных */
    public $isFavourite;

    /** @var int $priceMin минимальная цена */
    public $priceMin;

    /** @var int $priceMax максимальная цена */
    public $priceMax;

    /** @var string $title название */
    public $title;

    /** @var string $description описание */
    public $description;

    public function rules()
    {
        return [
            ['isFavourite', 'boolean'],
            [['priceMin', 'priceMax'], 'number'],
            [['title', 'description'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'isFavourite' => 'Выбрать из избранных',
            'priceMin'=> 'Цена мин',
            'priceMax' => 'Цена мах',
            'title' => 'Название',
            'description' => 'Описание',
        ];
    }
}