<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EnfermedadesSintomas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enfermedades-sintomas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'enfermedad_id')->textInput() ?>

    <?= $form->field($model, 'sintoma_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
