<?php

use yii\bootstrap\ButtonDropdown;
use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

Pjax::begin();
echo ButtonDropdown::widget([
    'label' => $datesItem[$curentDateId]['label'],
    'dropdown' => [
        'items' => $datesItem,
    ],
]);

echo GridView::widget([
    'dataProvider' => $pricesValues,
    'columns' => [
        'currency.title',
        'purchase',
        'sale',
        'interbank',
        'nbu',
        [
            'attribute' => 'note.note',
            'format' => 'html',
            'value' => function($data){
                $btn = Html::a('Добавить заметку', ['prices/update/'.$data->id], ['class' => 'btn btn-success btn-xs']);
                return $data->note ? $data->note->note : $btn ;
            }
        ],
    ],
]);
Pjax::end();