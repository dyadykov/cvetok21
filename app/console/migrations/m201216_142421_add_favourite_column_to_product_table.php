<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%product}}`.
 */
class m201216_142421_add_favourite_column_to_product_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('product', 'isFavourite', $this->boolean()->defaultValue(false));
    }

    public function safeDown()
    {
        $this->dropColumn('product', 'isFavourite');
    }
}
