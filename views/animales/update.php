<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Animales */

$this->title = 'Actualizar Animal: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Animales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="animales-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'especies' => $especies,
    ]) ?>

</div>
