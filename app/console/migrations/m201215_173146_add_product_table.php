<?php

use frontend\models\Product;
use yii\db\Migration;

/**
 * Class m201215_173146_add_product_table
 */
class m201215_173146_add_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(Product::tableName(), [
            'id' => $this->primaryKey(),
            'src' => $this->string(),
            'alt' => $this->string(),
            'isActive' => $this->boolean(),
            'title' => $this->string(),
            'description' => $this->string(),
            'price' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(Product::tableName());
    }
}
