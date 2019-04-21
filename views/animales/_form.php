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

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

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

    <?= $form->field($model, 'nacimiento')->widget(DatePicker::className(), [
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
        ]
        ]) ?>

    <?= $form->field($model, 'chip')->textInput(['maxlength' => true]) ?>

    <?php if (isset($especies)): ?>
        <?= $form->field($model, 'especie_id')->dropDownList($especies) ?>
    <?php endif; ?>


    <?= $form->field($model, 'ppp')->checkbox() ?>

    <?= $form->field($model, 'esterilizado')->checkbox() ?>

    <?= $form->field($model, 'sexo')->radioList([
        'h' => 'Hembra',
        'm' => 'Macho',
        ]) ?>

    <?= $form->field($model, 'observaciones')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Siguiente >', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
