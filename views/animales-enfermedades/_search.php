<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnimalesEnfermedadesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="animales-enfermedades-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'enfermedad_id') ?>

    <?= $form->field($model, 'animal_id') ?>

    <?= $form->field($model, 'desde') ?>

    <?= $form->field($model, 'hasta') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
