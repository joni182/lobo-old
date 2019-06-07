<?php

use kartik\date\DatePicker;

use kartik\number\NumberControl;

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnimalesSearch */
/* @var $form yii\widgets\ActiveForm */

$js = <<<JS
    $('button.avanzado').click((e)=>{
        e.preventDefault();
        $('div.avanzado').toggle(500);
    });
JS;

$this->registerJs($js)
?>

<div class="animales-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <fieldset>
            <legend>Fecha</legend>
            <div class="col-sm-6">
                <?= $form->field($model, 'desde')->widget(DatePicker::className(), [
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ]
                    ])->label('Desde') ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'hasta')->widget(DatePicker::className(), [
                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'format' => 'yyyy-mm-dd'
                        ]
                        ])->label('Hasta') ?>
                    </div>
                </fieldset>
            </div>
            <div class="avanzado">
    <?= $form->field($model, 'persona')->label('Adoptante') ?>
    <?= $form->field($model, 'animal')->label('Animal') ?>

    <?php $especies = ['' => ''] + $especies ?>
    <?= $form->field($model, 'grupo')->dropDownList($especies)->label('Grupo')?>








                </div>
                    <div class="form-group">
                        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
                        <?= Html::button('Avanzado +',['class' => 'btn avanzado btn-default']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
