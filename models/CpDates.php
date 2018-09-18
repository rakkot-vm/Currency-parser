<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%cp_dates}}".
 *
 * @property int $id
 * @property int $date
 *
 * @property CpAvgprices[] $cpAvgprices
 */
class CpDates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cp_dates}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCpAvgprices()
    {
        return $this->hasMany(CpAvgprices::className(), ['date_id' => 'id']);
    }
}
