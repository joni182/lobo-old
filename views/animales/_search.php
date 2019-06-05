<?php

use kartik\date\DatePicker;

use kartik\number\NumberControl;

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnimalesSearch */
/* @var $form yii\widgets\ActiveForm */

$js = <<<JS
    $('a.avanzado').click((e)=>{
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

    <?= $form->field($model, 'nombre') ?>
<div class="avanzado">

    <?= $form->field($model, 'chip') ?>
    <div class="row">
        <fieldset>
            <legend>Nacimiento</legend>
            <div class="col-sm-6">
                <?= $form->field($model, 'nacimiento_desde')->widget(DatePicker::className(), [
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ]
                    ])->label('Desde') ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'nacimiento_hasta')->widget(DatePicker::className(), [
                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'format' => 'yyyy-mm-dd'
                        ]
                        ])->label('Hasta') ?>
                    </div>
                </fieldset>
            </div>


            <div class="row">
                <fieldset>
                    <legend>Peso</legend>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'peso_desde')->widget(NumberControl::class, [
                            'maskedInputOptions' => [
                                'suffix' => ' Kg',
                                'allowMinus' => false,
                                'groupSeparator' => '',
                                'radixPoint' => ',',
                                'min' => 0,
                                'max' => 9999,
                            ],
                            ])->label('Desde') ?>
                        </div>

                        <div class="col-sm-6">
                            <?= $form->field($model, 'peso_hasta')->widget(NumberControl::class, [
                                'maskedInputOptions' => [
                                    'suffix' => ' Kg',
                                    'allowMinus' => false,
                                    'groupSeparator' => '',
                                    'radixPoint' => ',',
                                    'min' => 0,
                                    'max' => 9999,
                                ],
                                ])->label('Hasta') ?>
                            </div>
                        </fieldset>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <?= $form->field($model, 'ppp')->dropDownList([
                                '' => '',
                                '1' => 'PPP',
                                '0' => 'NO PPP',
                            ])
                            ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'esterilizado')->dropDownList([
                                '' => '',
                                '1' => 'Esterilizado',
                                '0' => 'NO Esterilizado',
                            ])
                            ?>
                        </div>
                        <div class="col-sm-4">
                            <?php echo $form->field($model, 'sexo')->dropDownList($model->sexosDisponibles()) ?>
                        </div>
                    </div>



                    <?php echo $form->field($model, 'observaciones') ?>

                    <?php // echo $form->field($model, 'created_at') ?>

                    <?php // echo $form->field($model, 'updated_at') ?>

                </div>
                    <div class="form-group">
                        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Avanzado +', '',['class' => 'btn avanzado btn-default']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
