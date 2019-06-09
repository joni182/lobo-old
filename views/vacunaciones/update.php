<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vacunaciones */

$this->title = 'Actualizar: ' . $model->vacuna->vacuna;
$this->params['breadcrumbs'][] = ['label' => 'Vacunaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vacunaciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'vacunas' => $vacunas,
    ]) ?>

</div>
