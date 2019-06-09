<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\number\NumberControl;

/* @var $this yii\web\View */
/* @var $model app\models\Animales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="animales-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'peso')->widget(NumberControl::class, [
                'maskedInputOptions' => [
                    'suffix' => ' Kg',
                    'allowMinus' => false,
                    'groupSeparator' => '',
                    'radixPoint' => ',',
                    'min' => 0,
                    'max' => 9999,
                ],
            ])
            ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'nacimiento')->widget(DatePicker::className(), [
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]
                ]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'especie_id')->dropDownList($especies) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'chip')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-12 flex center-h">
            <?= $form->field($model, 'ppp')->checkbox() ?>
        </div>
        <div class="col-sm-12 flex center-h">
            <?= $form->field($model, 'esterilizado')->checkbox() ?>
        </div>
        <div class="col-sm-12 flex center-h">
            <?= $form->field($model, 'sexo')->radioList([
                'h' => 'Hembra',
                'm' => 'Macho',
                ]) ?>
        </div>

    </div>
    <?= $form->field($model, 'observaciones')->textarea(['rows' => 3]) ?>

    <div class="form-group  flex center-h">
        <?= Html::submitButton('Siguiente >', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
