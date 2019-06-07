<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TratamientosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tratamientos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'medicamento_id') ?>

    <?= $form->field($model, 'animal_id') ?>

    <?= $form->field($model, 'inicio') ?>

    <?= $form->field($model, 'duracion') ?>

    <?php // echo $form->field($model, 'dosis') ?>

    <?php // echo $form->field($model, 'veces_por_dia') ?>

    <?php // echo $form->field($model, 'observaciones') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
