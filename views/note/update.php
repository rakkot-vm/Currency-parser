<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CpNotes */

$this->title = 'Update Cp Notes: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cp Notes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cp-notes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
