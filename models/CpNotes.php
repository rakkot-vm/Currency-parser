<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%cp_notes}}".
 *
 * @property int $id
 * @property string $note
 */
class CpNotes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cp_notes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['note'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'note' => 'Заметка',
        ];
    }
}
