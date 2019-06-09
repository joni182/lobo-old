<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Vacunas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vacunas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'vacuna')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dosis')->textInput() ?>

    <?= $form->field($model, 'entre_dosis')->textInput() ?>

    <?= $form->field($model, 'periodicidad')->textInput() ?>

    <?= $form->field($model, 'observaciones')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
