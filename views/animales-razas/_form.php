<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnimalesRazas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="animales-razas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'animal_id')->textInput() ?>

    <?= $form->field($model, 'raza_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
