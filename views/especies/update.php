<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Especies */

$this->title = 'Actualizar especie: ' . $model->especie;
$this->params['breadcrumbs'][] = ['label' => 'Especies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->especie, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="especies-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
