<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CpNotes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cp-notes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_id')->textInput() ?>

    <?= $form->field($model, 'var_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
