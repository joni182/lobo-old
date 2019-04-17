<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnimalesColores */

$this->title = 'Update Animales Colores: ' . $model->animal_id;
$this->params['breadcrumbs'][] = ['label' => 'Animales Colores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->animal_id, 'url' => ['view', 'animal_id' => $model->animal_id, 'color_id' => $model->color_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="animales-colores-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
