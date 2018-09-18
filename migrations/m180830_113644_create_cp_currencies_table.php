<?php

use yii\db\Migration;

/**
 * Handles the creation of table `varities`.
 */
class m180830_113644_create_cp_currencies_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('cp_currencies', [
            'id' => $this->primaryKey(2),
            'title' => $this->string(3)->notNull(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('cp_currencies');
    }
}
