<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CpNotes */

$this->title = 'Update Cp Prices: ' . $model->id;
?>
<div class="cp-notes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="cp-notes-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($modelNotes, 'note')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
