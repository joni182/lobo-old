<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PersonasSearch */
/* @var $form yii\widgets\ActiveForm */
$js = <<<JS
    $('button.avanzado').click((e)=>{
        e.preventDefault();
        $('div.avanzado').toggle(500);
    });
JS;

$this->registerJs($js)
?>

<div class="personas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'nombre') ?>
<div class="avanzado">

    <?= $form->field($model, 'primer_apellido') ?>

    <?= $form->field($model, 'segundo_apellido') ?>

    <?= $form->field($model, 'direccion') ?>

    <?= $form->field($model, 'telefono') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'observaciones') ?>

</div>
    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::button('Avanzado +',['class' => 'btn avanzado btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
