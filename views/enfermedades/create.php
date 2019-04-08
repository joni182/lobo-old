<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Enfermedades */

$this->title = 'Registra una enfermedad';
$this->params['breadcrumbs'][] = ['label' => 'Enfermedades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enfermedades-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
