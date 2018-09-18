<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CpNotes */

$this->title = 'Create Cp Notes';
$this->params['breadcrumbs'][] = ['label' => 'Cp Notes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cp-notes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
