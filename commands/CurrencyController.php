<?php

namespace app\commands;

use app\models\CpAvgprices;
use app\models\CpCurrencies;
use app\models\CpDates;
use app\models\CpPrices;
use Yii;
use yii\console\Controller;

class CurrencyController extends Controller
{
    /**
     * Attempt to pull and create new currency values
     */
    public function actionParse()
    {
        $values = CpPrices::curValues();

        /*if the values were not changed, we interrupt execution*/
        if( !(new CpPrices())->isChange($values) ){
          return;
        }

        foreach ($values as $currency => $value) {
            $model = new CpPrices();
            $model->loadValues($value, $currency);
            if(!$model->save()){
                return;
            }

            /*If there is no such currency, we create it and associate it with the values (cp_prices)*/
            if(!$model->currency_id) {
                $modelCurrency = new CpCurrencies();
                $modelCurrency->title = $currency;
                if($modelCurrency->save()) {
                    $model->link('currency', $modelCurrency);
                }
            }
            /*If there is no such date, we create it and associate it with the values (cp_prices)*/
            if(!$model->date_id) {
                $modelDate = new CpDates();
                $modelDate->date = $_SERVER['REQUEST_TIME'];
                if($modelDate->save()) {
                    $model->link('date', $modelDate);
                }
            }
        }

    }

    /**
     * Creates averages for the day
     */
    public function actionCreateAvgPrices()
    {
        $startDayTime = mktime(0, 0, 0, date('n'), date('d'),  date('o'));
        $lastDateIds = CpDates::find(['<', 'date', $startDayTime])->all();
        $lastDateIds = array_map( function($date) {
            return $date->id;
        }, $lastDateIds);

        $currencies = CpCurrencies::find()->all();
        foreach($currencies as $carrency ) {
            $model = new CpAvgprices();

            $model->loadAvgPrices($lastDateIds, $carrency );
            $model->save();
        }
    }

    /**
     * return view with last currencie values
     * @return mixed
     */
    public function getLastCurrenciesView()
    {
        $idTargetDate = CpDates::find()->orderBy('date DESC')->one()->id;
        $currencyValues = CpPrices::find()->where(['date_id' => $idTargetDate])->all();
        return ['currencyValues' => $currencyValues];
    }

    public function actionSendSmtpMail()
    {
        Yii::$app->mailerSmtp->compose('currency-mail',$this->getLastCurrenciesView())
            ->setFrom(Yii::$app->params['mailFrom'])
            ->setTo(Yii::$app->params['mailTo'])
            ->setSubject('Тест Парсер курса валют || текущий курс валют SmtpMail')
            ->send();
    }

    public function actionSendMail()
    {
        Yii::$app->mailer->compose('currency-mail',$this->getLastCurrenciesView())
            ->setFrom(Yii::$app->params['mailFrom'])
            ->setTo(Yii::$app->params['mailTo'])
            ->setSubject('Тест Парсер курса валют || текущий курс валют SendMail')
            ->send();
    }

}
