<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cp_notes`.
 */
class m180830_115010_create_cp_notes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('cp_notes', [
            'id' => $this->primaryKey(5),
            'note' => $this->string(512),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('cp_notes');
    }
}
