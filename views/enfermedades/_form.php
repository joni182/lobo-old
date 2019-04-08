<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Enfermedades */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enfermedades-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'enfermedad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::checkbox('sintomas', false, ['class' => 'form-check-input']) ?><span class="text-danger"> Agregar síntomas despues de guardar</span>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
