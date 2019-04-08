<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sintomas */

$this->title = 'Actualizar Sintoma: ' . $model->sintoma;
$this->params['breadcrumbs'][] = ['label' => 'Sintomas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sintoma, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sintomas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
