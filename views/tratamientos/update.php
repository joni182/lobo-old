<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tratamientos */

$this->title = 'Update Tratamientos: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tratamientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="tratamientos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
