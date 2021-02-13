<?php

namespace console\controllers;

use common\models\User;
use Exception;
use common\models\Product;
use common\models\Shop;
use common\models\Slide;
use Yii;
use yii\console\Controller;

class SyncController extends Controller
{
    public function actionIndex()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $products = Yii::$app->sourceDb->createCommand('SELECT * FROM product;')->queryAll();
            Yii::$app->db->createCommand()->truncateTable(Shop::tableName())->execute();
            Yii::$app->db->createCommand()->batchInsert(Product::tableName(), array_keys($products[0]), $products)->execute();

            $shops = Yii::$app->sourceDb->createCommand('SELECT * FROM shop;')->queryAll();
            Yii::$app->db->createCommand()->truncateTable(Shop::tableName())->execute();
            Yii::$app->db->createCommand()->batchInsert(Shop::tableName(), array_keys($shops[0]), $shops)->execute();

            $slides = Yii::$app->sourceDb->createCommand('SELECT * FROM slide;')->queryAll();
            Yii::$app->db->createCommand()->truncateTable(Shop::tableName())->execute();
            Yii::$app->db->createCommand()->batchInsert(Slide::tableName(), array_keys($slides[0]), $slides)->execute();

            $users = Yii::$app->sourceDb->createCommand('SELECT * FROM user;')->queryAll();
            Yii::$app->db->createCommand()->truncateTable(Shop::tableName())->execute();
            Yii::$app->db->createCommand()->batchInsert(User::tableName(), array_keys($users[0]), $users)->execute();

            $transaction->commit();
        } catch (Exception $exception) {
            $transaction->rollBack();
        }
    }
}
