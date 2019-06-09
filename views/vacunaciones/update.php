<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vacunaciones */

$this->title = 'Update Vacunaciones: ' . $model->vacuna_id;
$this->params['breadcrumbs'][] = ['label' => 'Vacunaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->vacuna_id, 'url' => ['view', 'vacuna_id' => $model->vacuna_id, 'animal_id' => $model->animal_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vacunaciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
