<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnimalesColores */

$this->title = 'Create Animales Colores';
$this->params['breadcrumbs'][] = ['label' => 'Animales Colores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animales-colores-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
