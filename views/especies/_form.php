<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Especies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="especies-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'especie')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
