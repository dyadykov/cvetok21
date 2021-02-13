<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m210213_151530_modify_cart_tables
 */
class m210213_151530_modify_cart_tables extends Migration
{

    public function safeUp()
    {
        $this->renameColumn('cart_product', 'cart_id', 'user_id');
        $this->dropTable('cart');
        $this->renameTable('cart_product','cart');
    }

    public function safeDown()
    {
        $this->renameTable('cart','cart_product');
        $this->createTable('cart', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
        ]);
        foreach (User::find()->all() as $user) {
            $this->insert('cart', [
                'id' => $user->id,
                'user_id' => $user->id,
            ]);
        }
        $this->renameColumn('cart_product', 'user_id', 'cart_id');
    }
}
