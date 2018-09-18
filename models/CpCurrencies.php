<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%cp_currencies}}".
 *
 * @property int $id
 * @property string $title
 *
 * @property CpAvgprices[] $cpAvgprices
 * @property CpPrices[] $cpPrices
 */
class CpCurrencies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cp_currencies}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Валюта',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCpAvgprices()
    {
        return $this->hasMany(CpAvgprices::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCpPrices()
    {
        return $this->hasMany(CpPrices::className(), ['currency_id' => 'id']);
    }
}
