<?php

use frontend\models\Slide;
use yii\db\Migration;

/**
 * Class m201212_160839_add_slide_table
 */
class m201212_160839_add_slide_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(Slide::tableName(), [
            'id' => $this->primaryKey(),
            'src' => $this->string(),
            'alt' => $this->string(),
            'pos' => $this->integer(),
            'url' => $this->string(),
            'isActive' => $this->boolean(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('slide');
    }
}
