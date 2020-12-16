<?php

use frontend\models\Product;
use yii\db\Migration;

/**
 * Handles adding columns to table `{{%product}}`.
 */
class m201216_142421_add_position_column_to_product_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn(Product::tableName(), 'isFavourite', $this->boolean()->defaultValue(false));
    }

    public function safeDown()
    {
        $this->dropColumn(Product::tableName(), 'isFavourite');
    }
}
