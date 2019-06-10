<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EnfermedadesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="enfermedades-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'enfermedad') ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'descripcion') ?>
        </div>
        <div class="col-md-1">
            <div class="form-group">
                <br>
                <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>



    <?php ActiveForm::end(); ?>

</div>
