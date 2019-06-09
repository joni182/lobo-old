<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Vacunaciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vacunaciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'vacuna_id')->textInput() ?>

    <?= $form->field($model, 'animal_id')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
