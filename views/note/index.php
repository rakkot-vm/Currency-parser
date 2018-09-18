<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cp Notes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cp-notes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cp Notes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'note',
            'date_id',
            'var_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
