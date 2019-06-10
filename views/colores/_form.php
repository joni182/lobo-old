<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Colores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="colores-form">

    <?php $form = ActiveForm::begin(isset($conf) ? $conf : null); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <br>
            <?= $form->field($model, 'color', [
                'template' => "{input}"
                ])->input('color',['class'=>"input_class"]) ?>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <br>
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>



    <?php ActiveForm::end(); ?>

</div>
