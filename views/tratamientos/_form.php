<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tratamientos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tratamientos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'medicamento_id')->textInput() ?>

    <?= $form->field($model, 'animal_id')->textInput() ?>

    <?= $form->field($model, 'inicio')->textInput() ?>

    <?= $form->field($model, 'duracion')->textInput() ?>

    <?= $form->field($model, 'dosis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'veces_por_dia')->textInput() ?>

    <?= $form->field($model, 'observaciones')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
