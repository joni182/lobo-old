<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EnfermedadesSintomas */

$this->title = 'Update Enfermedades Sintomas: ' . $model->enfermedad_id;
$this->params['breadcrumbs'][] = ['label' => 'Enfermedades Sintomas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->enfermedad_id, 'url' => ['view', 'enfermedad_id' => $model->enfermedad_id, 'sintoma_id' => $model->sintoma_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="enfermedades-sintomas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
