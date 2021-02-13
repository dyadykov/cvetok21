<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m210213_153712_modify_favourite_tables
 */
class m210213_153712_modify_favourite_tables extends Migration
{

    public function safeUp()
    {
        $this->renameColumn('favourite_product', 'favourite_id', 'user_id');
        $this->dropTable('favourite');
        $this->renameTable('favourite_product','favourite');
    }

    public function safeDown()
    {
        $this->renameTable('favourite','favourite_product');
        $this->createTable('favourite', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
        ]);
        foreach (User::find()->all() as $user) {
            $this->insert('favourite', [
                'id' => $user->id,
                'user_id' => $user->id,
            ]);
        }
        $this->renameColumn('favourite_product', 'user_id', 'favourite_id');
    }
}
