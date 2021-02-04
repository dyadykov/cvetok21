<?php

use frontend\models\Favourite;
use frontend\models\FavouriteProduct;
use frontend\models\Product;
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
        $this->renameColumn(Product::tableName(), 'isFavourite', 'isPopular');

        $this->createTable(Favourite::tableName(), [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
        ]);

        $this->createTable(FavouriteProduct::tableName(),[
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
        $this->dropTable(FavouriteProduct::tableName());
        $this->dropTable(Favourite::tableName());
        $this->renameColumn(Product::tableName(), 'isPopular', 'isFavourite');
    }
}
