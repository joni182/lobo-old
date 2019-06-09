<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Vacunas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vacunas-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'vacuna')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'dosis')->dropDownList([
                1 => 1,
                2 => 2,
                3 => 3,
                4 => 4,
                5 => 5,
                ]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'entre_dosis')->dropDownList([
                '' => '',
                'P7D' => '7 das',
                'P15D' => '15 días',
                'P1M' => '1 mes',
                'P2M' => '2 meses',
                'P6M' => '10 meses',

                ]) ?>
        </div>
        <!-- <div class="col-md-2">
            <?php //echo $form->field($model, 'periodicidad')->dropDownList([
                // '' => '',
                // 'P1Y' => 'Cada año',
                // 'P2Y' => 'Cada 2 años',
                // 'P3Y' => 'Cada 3 años',
                // 'P4Y' => 'Cada 4 años',
                // 'P5Y' => 'Cada 5 años',
                // 'P6Y' => 'Cada 6 años',
                // 'P7Y' => 'Cada 7 años',
                //
                // ]) ?>
        </div> -->
    </div>




    <?= $form->field($model, 'observaciones')->textarea(['rows' => 2]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
