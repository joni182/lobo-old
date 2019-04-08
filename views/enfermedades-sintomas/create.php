<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EnfermedadesSintomas */

$this->title = 'Create Enfermedades Sintomas';
$this->params['breadcrumbs'][] = ['label' => 'Enfermedades Sintomas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enfermedades-sintomas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
