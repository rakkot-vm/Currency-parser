<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cp_prices`.
 */
class m180830_115012_create_cp_prices_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('cp_prices', [
            'id' => $this->primaryKey(6),
            'currency_id' => $this->integer(3),
            'date_id' => $this->integer(11),
            'note_id' => $this->integer(6),

            'purchase' => $this->float(),
            'sale' => $this->float(),
            'interbank' => $this->float(),
            'nbu' => $this->float(),
        ]);

        $this->addForeignKey(
            'fk-date_id-date',
            'cp_prices',
            'date_id',
            'cp_dates',
            'id',
            'NO ACTION'
        );

        $this->addForeignKey(
            'fk-currency_id-id',
            'cp_prices',
            'currency_id',
            'cp_currencies',
            'id',
            'NO ACTION'
        );

        $this->addForeignKey(
            'fk-note_id-id',
            'cp_prices',
            'note_id',
            'cp_notes',
            'id',
            'NO ACTION'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('cp_prices');
    }
}
