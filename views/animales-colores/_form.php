<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnimalesColores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="animales-colores-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'animal_id')->textInput() ?>

    <?= $form->field($model, 'color_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
