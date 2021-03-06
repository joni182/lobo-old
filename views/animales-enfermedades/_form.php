<?php

use kartik\date\DatePicker;

use kartik\widgets\Select2;

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnimalesEnfermedades */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="animales-enfermedades-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'enfermedad_id')->widget(Select2::classname(), [
        'data' => $enfermedades,
        'options' => ['placeholder' => 'Selecciona una enfermedad ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'animal_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'desde')->widget(DatePicker::className(), [
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
        ]
        ]) ?>

    <?= $form->field($model, 'hasta')->widget(DatePicker::className(), [
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
        ]
        ]) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
