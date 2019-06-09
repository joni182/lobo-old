<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsuariosInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'usuario_id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'primer_apellido') ?>

    <?= $form->field($model, 'segundo_apellido') ?>

    <?php // echo $form->field($model, 'login') ?>

    <?php // echo $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'access_token') ?>

    <?php // echo $form->field($model, 'validate_token') ?>

    <?php // echo $form->field($model, 'validated_at') ?>

    <?php // echo $form->field($model, 'rol_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
