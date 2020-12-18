<?php


namespace common\widgets;


use Exception;
use frontend\models\Shop;
use mirocow\yandexmaps\Canvas;
use mirocow\yandexmaps\Map;
use mirocow\yandexmaps\objects\Placemark;

class Shops
{
    // TODO 3 переделать PHPDoc
    /**
     * Отрисовывает контакты магазинов и ихнее положение на карте
     *
     * @param array $params массив содержит параметры виджета<br>
     * Модели - экземпляры классов с набором свойств, присущим виджету (title, <br>description, lat, lon, worktime, worktime_sat, worktime_sun, phone, address)<br>
     * @return string выходящая строка HTML кода
     * @throws Exception
     */
    public static function widget(array $params)
    {
        /** @var Shop $model */
        /** @var Shop[] $models */
        $models = $params['models'];
        $cards = '';
        $geoObjects = [];

        foreach ($models as $model) {
            $card = '<div class="mb-3">
                        <b>' . $model->title . '</b>
                        <br>
                        ' . $model->address . '
                        <br>
                        Пн-Пт: ' . $model->worktime . ', Сб: ' . $model->worktime_sat . ', Вс: ' . $model->worktime_sun . '
                        <br>
                        Телефон <a href="tel:' . $model->phone . '">' . $model->phone . '</a>
                        <hr>
			         </div>';

            $cards .= $card;

            $geoObjects[] = new Placemark([
                $model->lat,
                $model->lon,
            ], [
                "iconCaption" => $model->title,
                "balloonContentHeader" => $model->title,
                "balloonContentBody" =>
                    $model->address . '
                        <br>
                        Пн-Пт ' . $model->worktime . ', Сб ' . $model->worktime_sat . ', Вс ' . $model->worktime_sun . '
                        <br>
                        Телефон <a href="tel:' . $model->phone . '">' . $model->phone . '</a>
                        <br>
                        <a href="https://yandex.ru/maps/?rtext=~' . $model->lat . ',' . $model->lon . '&rtt=auto" target="_blank">Построить маршру</a>',
            ], [
                'preset' => 'islands#blueShoppingCircleIcon',
            ]);
        }

        $map = new Map('yandex_map', [
            'center' => [56.128654, 47.239894],
            'zoom' => 12,
            'behaviors' => ['default', 'scrollZoom'],
            'type' => "yandex#map",
            'controls' => [],
        ],
            [
                'controls' => [
                    'new ymaps.control.ZoomControl({options: {size: "small"}})',
                    'search' => 'new ymaps.control.SearchControl({options: {size: "small"}})',
                ],
                'behaviors' => [
                    'scrollZoom' => 'disable',
                ],
                'objects' => $geoObjects,

            ],
        );

        $yandexMap = Canvas::widget([
            'htmlOptions' => [
                'style' => 'height: 500px;',
            ],
            'map' => $map,
        ]);

        return '<div class="row" style="min-height: 500px;">' .
            '<div class="col-lg-6 col-12">' .
            $cards .
            '</div>' .
            '<div class="col-lg-6 col-12">' .
            $yandexMap .
            '</div>' .
            '</div>';
    }
}