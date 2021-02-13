<?php

use yii\db\Migration;

/**
 * Class m201219_155431_add_cart_table
 */
class m201219_155431_add_cart_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('cart', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
        ]);

        $this->createTable('cart_product', [
            'id' => $this->primaryKey(),
            'cart_id' => $this->integer(),
            'product_id' => $this->integer(),
            'quantity' => $this->integer(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('cart_product');
        $this->dropTable('cart');
    }
}
