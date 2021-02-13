<?php

use yii\db\Migration;

/**
 * Class m201216_152357_add_shop_table
 */
class m201216_152357_add_shop_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('shop', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'description' => $this->string(),
            'lat' => $this->decimal(8, 6),
            'lon' => $this->decimal(8, 6),
            'worktime' => $this->string(),
            'worktime_sat' => $this->string(),
            'worktime_sun' => $this->string(),
            'phone' => $this->string(),
            'address' => $this->string(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('shop');
    }
}
