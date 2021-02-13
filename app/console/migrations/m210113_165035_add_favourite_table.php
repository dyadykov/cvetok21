<?php

use yii\db\Migration;

/**
 * Class m210113_165035_add_favourite_table
 */
class m210113_165035_add_favourite_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('product', 'isFavourite', 'isPopular');

        $this->createTable('favourite', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
        ]);

        $this->createTable('favourite_product', [
            'id' => $this->primaryKey(),
            'favourite_id' => $this->integer(),
            'product_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('favourite_product');
        $this->dropTable('favourite');
        $this->renameColumn('product', 'isPopular', 'isFavourite');
    }
}
