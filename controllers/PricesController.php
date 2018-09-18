<?php

namespace app\controllers;

use app\models\CpDates;
use app\models\CpNotes;
use app\models\CpPrices;
use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

class PricesController extends Controller
{
    public function actionView($date_id = '')
    {
        $idTargetDate = !$date_id ? CpDates::find()->orderBy('date DESC')->one()->id : $date_id ;

        $dates = new ActiveDataProvider([
            'query' => (new Query())->from('cp_dates'),
        ]);
        $dates = ArrayHelper::map($dates->getModels(),'id','date');
        $datesItem = [];

        foreach ($dates as $date_id => $date){
            $formatedDate = date("Y-m-d H:i:s", $date);
            $datesItem[$date_id] = ['label' => $formatedDate, 'url' => Url::to('/prices/view/'.$date_id, true)];
        }

        $pricesValues = new ActiveDataProvider([
            'query' => CpPrices::find()->where(['date_id' => $idTargetDate]),
        ]);

        return $this->render('index', [
            'pricesValues' => $pricesValues,
            'datesItem' => $datesItem,
            'curentDateId' => $idTargetDate
        ]);
    }

    public function actionUpdate($id)
    {
        $modelNotes = (new CpNotes());
        $modelPrices = (new CpPrices())->findOne($id);

        $modelNotes->attributes = Yii::$app->request->post('CpNotes' );
        if ($modelNotes->note && $modelNotes->save()){
            $modelPrices->link('note',$modelNotes);
            return $this->redirect(['/prices/view/'.$modelPrices->date_id]);
        } else {
            return $this->render('update', [
                'model' => $modelPrices,
                'modelNotes' => $modelNotes
            ]);
        }
    }
}


























