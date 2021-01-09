<?php

use frontend\models\Cart;
use frontend\models\CartProduct;
use yii\db\Migration;

/**
 * Class m201219_155431_add_cart_table
 */
class m201219_155431_add_cart_table extends Migration
{
    public function safeUp()
    {
        $this->createTable(Cart::tableName(), [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
        ]);

        $this->createTable(CartProduct::tableName(),[
            'id' => $this->primaryKey(),
            'cart_id' => $this->integer(),
            'product_id' => $this->integer(),
            'quantity' => $this->integer(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable(CartProduct::tableName());
        $this->dropTable(Cart::tableName());
    }
}
