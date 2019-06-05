<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnimalesEnfermedades */

$this->title = 'Create Animales Enfermedades';
$this->params['breadcrumbs'][] = ['label' => 'Animales Enfermedades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animales-enfermedades-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'enfermedades' => $enfermedades,
    ]) ?>

</div>
