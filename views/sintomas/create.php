<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sintomas */

$this->title = 'Registrar Síntomas';
$this->params['breadcrumbs'][] = ['label' => 'Sintomas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sintomas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
