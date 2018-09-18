<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cp_dayprices`.
 */
class m180830_115237_create_cp_avgprices_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('cp_avgprices', [
            'id' => $this->primaryKey(5),
            'date' => $this->integer(11),
            'currency' => $this->string(3),

            'purchase' => $this->float(),
            'sale' => $this->float(),
            'interbank' => $this->float(),
            'nbu' => $this->float(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('cp_avgprices');
    }
}
