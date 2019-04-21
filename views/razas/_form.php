<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Razas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="razas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'raza')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'especie_id')->dropDownList($especies) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
