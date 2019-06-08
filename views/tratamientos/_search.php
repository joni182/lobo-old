<?php

use kartik\widgets\Select2;

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

    <div class="row">
        <div class="col-sm-5">
            <?= $form->field($model, 'animal_id')->widget(Select2::classname(), [
                'data' => $animales,
                'options' => ['placeholder' => 'Selecciona un animal ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model, 'medicamento_id')->widget(Select2::classname(), [
                'data' => $medicamentos,
                'options' => ['placeholder' => 'Selecciona un medicamento ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
            <div class="col-sm-2">

                <div class="form-group">
                    <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>



    <?php // echo $form->field($model, 'dosis') ?>

    <?php // echo $form->field($model, 'veces_por_dia') ?>

    <?php // echo $form->field($model, 'observaciones') ?>


    <?php ActiveForm::end(); ?>

</div>
