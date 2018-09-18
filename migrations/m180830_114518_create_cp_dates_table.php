<?php

use yii\db\Migration;

/**
 * Handles the creation of table `dates`.
 */
class m180830_114518_create_cp_dates_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('cp_dates', [
            'id' => $this->primaryKey(6),
            'date' => $this->integer(11),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('cp_dates');
    }
}
