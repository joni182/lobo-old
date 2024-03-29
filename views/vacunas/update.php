<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vacunas */

$this->title = 'Actualizar: ' . $model->vacuna;
$this->params['breadcrumbs'][] = ['label' => 'Vacunas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->vacuna, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vacunas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
