<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnimalesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="animales-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'nacimiento') ?>

    <?= $form->field($model, 'chip') ?>

    <?= $form->field($model, 'peso') ?>

    <?php // echo $form->field($model, 'ppp')->checkbox() ?>

    <?php // echo $form->field($model, 'esterilizado')->checkbox() ?>

    <?php // echo $form->field($model, 'sexo') ?>

    <?php // echo $form->field($model, 'observaciones') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
