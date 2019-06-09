<?php

use kartik\date\DatePicker;

use kartik\widgets\Select2;

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Vacunaciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vacunaciones-form">

    <?php $form = ActiveForm::begin(isset($url) ? $url : null); ?>

    <?= $form->field($model, 'animal_id')->hiddenInput()->label(false) ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'vacuna_id')->widget(Select2::classname(), [
                'data' => $vacunas,
                'options' => ['placeholder' => 'Selecciona una vacuna...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'fecha')->widget(DatePicker::className(), [
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]
                ]) ?>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <br>
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
