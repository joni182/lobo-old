<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnimalesEnfermedades */

$this->title = 'Update Animales Enfermedades: ' . $model->enfermedad_id;
$this->params['breadcrumbs'][] = ['label' => 'Animales Enfermedades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->enfermedad_id, 'url' => ['view', 'enfermedad_id' => $model->enfermedad_id, 'animal_id' => $model->animal_id, 'desde' => $model->desde]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="animales-enfermedades-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'enfermedades' => $enfermedades,
    ]) ?>

</div>
