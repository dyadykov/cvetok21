<?php

use yii\rest\UrlRule;

return [
    [
        'class' => UrlRule::class,
        'controller' => ['v1/product', 'v1/shop', 'v1/slide', 'v1/user'],
        'pluralize' => false,
    ],
    '<module>/<controller>/<action>/<id:(\d+)>' => '<module>/<controller>/<action>',
    '<module>/<controller>/<action>' => '<module>/<controller>/<action>',
    '<module>/<controller>' => '<module>/<controller>/index',
];