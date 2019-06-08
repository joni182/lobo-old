<?php

use kartik\date\DatePicker;

use kartik\number\NumberControl;

use kartik\widgets\Select2;

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tratamientos */
/* @var $form yii\widgets\ActiveForm */

//<div class="help-block">Medicamento no puede estar vacío.</div>

$js = <<<JS
    $('#w1').on('submit', (e)=>{
        e.preventDefault();
        form = $(e.target);
        if (form.find('#tratamientos-medicamento_id').val() == '') {
            return;
        }

        $.ajax({
            type:'POST',
            url:form.prop('action'),
            data:{
                _csrf:$('input[name="_csrf"]').val(),
                animal_id:$('#tratamientos-animal_id').val(),
                medicamento_id:$('#tratamientos-medicamento_id').val(),
                fecha:$('#tratamientos-fecha').val(),
                veces_por_dia:$('#tratamientos-veces_por_dia').val(),
                dosis:$('#tratamientos-dosis').val(),
                inicio:$('#tratamientos-inicio').val(),
                observaciones:$('#tratamientos-observaciones').val(),
                duracion:$('#tratamientos-duracion').val()
            },
            success: data => {
                $('.tabla-tratamientos').empty();
                console.log(data);
            },
        })

    });
JS;

$this->registerJs($js);
?>

<div class="tratamientos-form">

    <?php $form = ActiveForm::begin([
        'action' => ['tratamientos/create'],
    ]); ?>

    <?= $form->field($model, 'animal_id')->hiddenInput()->label(false) ?>
    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'medicamento_id')->widget(Select2::classname(), [
                'data' => $listaMedicamentos,
                'options' => ['placeholder' => 'Selecciona un medicamento ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'veces_por_dia')->dropDownList([
                1 => 'Cada 24H',
                2 => 'Cada 12H',
                3 => 'Cada 8H',
                4 => 'Cada 6H',
                6 => 'Cada 4H',
                8 => 'Cada 3H',
                12 => 'Cada 2H',
                24 => 'Cada 1H',
                ]) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'dosis')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">

            <?= $form->field($model, 'inicio')->widget(DatePicker::className(), [
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]
                ]) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'duracion')->widget(NumberControl::class, [
                'maskedInputOptions' => [
                    'suffix' => ' DÍAS',
                    'allowMinus' => false,
                    'groupSeparator' => '',
                    'radixPoint' => ',',
                    'min' => 0,
                    'max' => 9999,
                ],
                ]) ?>
            </div>
    </div>

    <div class="row">

        <div class="col-sm-12">
            <?= $form->field($model, 'observaciones')->textarea(['rows' => 2]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
