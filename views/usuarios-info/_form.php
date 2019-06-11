<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsuariosInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-info-form">
    <div class="row">
        <?php $form = ActiveForm::begin(); ?>

        <div class="col-md-6">
            <?= $form->field($model, 'login')->textInput([
                'maxlength' => true,
                'placeholder' => 'Login',
            ])->label(false) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'email')->textInput([
                'maxlength' => true,
                'placeholder' => 'Email',
            ])->label(false) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'password')->passwordInput([
                'maxlength' => true,
                'placeholder' => 'Password',
            ])->label(false) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'password_repeat')->passwordInput([
                'maxlength' => true,
                'placeholder' => 'Confirmar password',
            ])->label(false) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'nombre')->textInput([
                'maxlength' => true,
                'placeholder' => 'Nombre',
            ])->label(false) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'primer_apellido')->textInput([
                'maxlength' => true,
                'placeholder' => 'Primer apellido',
            ])->label(false) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'segundo_apellido')->textInput([
                'maxlength' => true,
                'placeholder' => 'Segundo apellido',
            ])->label(false) ?>
        </div>


        <div class="form-group row flex center-h">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success ']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
