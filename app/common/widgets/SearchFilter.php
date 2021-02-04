<?php


namespace common\widgets;


use frontend\models\Product;
use frontend\models\SearchForm;
use yii\bootstrap4\ActiveForm;

class SearchFilter
{
    public static function widget(ActiveForm $form, SearchForm $searchForm)
    {
        $titles = Product::find()->select('title')->where(['isActive' => 1])->column();
        $options = ['' => SearchForm::TITLE_NOT_CHOSEN] + array_combine($titles, $titles);

        $isPopular = $form->field($searchForm, 'isPopular')->checkbox();
        $priceMin = $form->field($searchForm, 'priceMin')->label(false)->input('number');
        $priceMax = $form->field($searchForm, 'priceMax')->label(false)->input('number');
        $title = $form->field($searchForm, 'title')->dropdownList($options);
        $description = $form->field($searchForm, 'description')->textInput();

        return "
            <label>Фильтр</label>
            $isPopular
            <hr>
            <label>Цены</label>
            <div class='form-row'>
                <div class='form-group col-md-6'>
                    $priceMin
                </div>
                <div class='form-group col-md-6'>
                    $priceMax
                </div>
            </div>
            <hr>
            $title
            <hr>
            $description
            <hr>
            <div class='form-group'>
                <button type='submit' class='btn btn-primary'>Применить</button>
                <button type='reset' class='btn btn-primary:hover'>Сбросить</button>
            </div>
        ";
    }
}