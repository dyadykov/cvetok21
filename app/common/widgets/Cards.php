<?php


namespace common\widgets;


use Exception;
use yii\bootstrap4\LinkPager;

class Cards
{
    /**
     * Отрисовывает карточки товаров с пагинацией страниц
     *
     * @param array $params массив содержит параметры виджета<br>
     * массив должен содержать Модели и Пагинацию<br>
     * Модели - экземпляры классов с набором свойств, присущим виджету (src, alt, title, descrittion, price)<br>
     * Пагинация - экземпляр класса Pagination с указанием количества Моделей
     * @return string выходящая строка HTML кода
     * @throws Exception
     */
    public function widget(array $params): string
    {
        $models = $params['models'];
        $pagination = $params['pagination'];
        $cards = '';

        foreach ($models as $model) {
            $card = '<div class="card text-center" >
                        <img class="card-img-top" src = "' . $model->src . '" alt = "<?= $model->alt ?>" >
                            <div class="card-body" >
                                <h5 class="card-title" > ' . $model->title . '</h5 >
                                <p class="card-text" > ' . $model->description . '</p >
                                <h3 > ' . $model->price . ' руб. </h3 >
                                <button type = "button" class="btn btn-danger btn-block" > Заказать</button >
                            </div >
                    </div >';
            $cards .= $card;
        }

        return '<div class="card-columns">' . $cards . '</div>' . LinkPager::widget(['pagination' => $pagination]);
    }
}