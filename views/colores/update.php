<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Colores */

$this->title = 'Update Colores: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Colores', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="colores-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
