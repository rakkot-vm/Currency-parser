<?php

namespace app\models;

use Symfony\Component\DomCrawler\Crawler;
use yii\db\Expression;
use yii\httpclient\Client;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%cp_prices}}".
 *
 * @property int $id
 * @property int $currency_id
 * @property int $date_id
 * @property int $note_id
 * @property double $purchase
 * @property double $sale
 * @property double $interbank
 * @property double $nbu
 *
 * @property CpCurrencies $currency
 * @property CpNotes $note
 */
class CpPrices extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%cp_prices}}';
    }

    public function rules()
    {
        return [
            [['currency_id', 'date_id', 'note_id'], 'integer'],
            [['purchase', 'sale', 'interbank', 'nbu'], 'number'],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => CpCurrencies::className(), 'targetAttribute' => ['currency_id' => 'id']],
            [['note_id'], 'exist', 'skipOnError' => true, 'targetClass' => CpNotes::className(), 'targetAttribute' => ['note_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'currency_id' => 'Currency ID',
            'date_id' => 'Date ID',
            'note_id' => 'Note ID',
            'purchase' => 'Покупка',
            'sale' => 'Продажа',
            'interbank' => 'Межбанк',
            'nbu' => 'НБУ',
        ];
    }

    /**
     * Have the values of currencies changed
     * @param array $values
     * @return bool
     */
    public function isChange(array $values)
    {
        $lastDate = CpDates::find()->orderBy('id DESC')->one()->id;

        foreach($values as $currency => $value){
            $curCurrencyId = CpCurrencies::findOne(['title' => $currency])->id;
            if(!$curCurrencyId) return false;

            $lastValues = $this->find()
                ->where( ['date_id' => $lastDate, 'currency_id' => $curCurrencyId] )
                ->one();

            if($lastValues->purchase == $value[0] || $lastValues->sale == $value[1]) return false;
            if($lastValues->interbank == $value[2] || $lastValues->nbu == $value[3]) return false;
        }

        return true;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(CpCurrencies::className(), ['id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNote()
    {
        return $this->hasOne(CpNotes::className(), ['id' => 'note_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDate()
    {
        return $this->hasOne(CpDates::className(), ['id' => 'date_id']);
    }

    public static function curValues()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('https://korrespondent.net/business/indexes/course_valjut/')
            ->addHeaders ([ ' content-type ' => ' text/html ' ])
            ->send();

        if ($response->isOk) {
            $crawler = (new Crawler($response->content))
                ->filter('table.indextable tbody')->first()
                ->filter('tr');

            $values = [];

            $crawler->each(function ($elem) use (&$values) {
                $curCurrency = strtolower($elem->filter('.biz_name')->text());
                if (!isset($values[$curCurrency])) {
                    $values[$curCurrency] = [];
                }

                $elem->filter('.biz_bold')->each(function ($elem) use (&$values, $curCurrency) {
                    array_push($values[$curCurrency], $elem->filter('.biz_bold')->text() );
                });

            });

            return $values;
        }
    }

    public function loadValues(array $values, $currency)
    {
        $this->currency_id = CpCurrencies::findOne(['title' => $currency])->id;
        $this->date_id = CpDates::findOne(['date' => $_SERVER['REQUEST_TIME']])->id;
        $this->purchase = $values[0];
        $this->sale = $values[1];
        $this->interbank = $values[2];
        $this->nbu = $values[3];
    }
}
