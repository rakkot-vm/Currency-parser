<?php

namespace app\models;

/**
 * This is the model class for table "{{%cp_avgprices}}".
 *
 * @property int $id
 * @property int $date
 * @property int $currency
 * @property double $purchase
 * @property double $sale
 * @property double $interbank
 * @property double $nbu
 */
class CpAvgprices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cp_avgprices}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'integer'],
            [['purchase', 'sale', 'interbank', 'nbu'], 'number'],
            [['currency'], 'string'],
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
            'currency' => 'Currency',
            'purchase' => 'Покупка',
            'sale' => 'Продажа',
            'interbank' => 'Межбанк',
            'nbu' => 'НБУ',
        ];
    }

    public function loadAvgPrices($lastDateIds, $carrency)
    {
        $modelsPrice = new CpPrices();

        $this->currency = $carrency->title;
        $this->date = mktime(0, 0, 0, date('n'), date('d'), date('o'));
        $this->purchase = $modelsPrice->find(['in', 'date_id' => $lastDateIds])->andWhere(['currency_id' => $carrency->id])->average('purchase');
        $this->sale = $modelsPrice->find(['in', 'date_id' => $lastDateIds])->andWhere(['currency_id' => $carrency->id])->average('sale');
        $this->interbank = $modelsPrice->find(['in', 'date_id' => $lastDateIds])->andWhere(['currency_id' => $carrency->id])->average('interbank');
        $this->nbu = $modelsPrice->find(['in', 'date_id' => $lastDateIds])->andWhere(['currency_id' => $carrency->id])->average('nbu');
    }
}
