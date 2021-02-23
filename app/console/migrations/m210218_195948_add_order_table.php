<?php

use yii\db\Migration;

/**
 * Class m210218_195948_add_order_table
 */
class m210218_195948_add_order_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('order', [
            "id" => $this->primaryKey(),
            "user_id" => $this->integer(),
            "status" => $this->integer(),
            "data" => $this->json(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('order');
    }
}
