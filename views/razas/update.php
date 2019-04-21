<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Razas */

$this->title = 'Actualizar Raza: ' . $model->raza;
$this->params['breadcrumbs'][] = ['label' => 'Razas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->raza, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="razas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'especies' => $especies,
    ]) ?>

</div>
