<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tratamientos */

$this->title = 'Create Tratamientos';
$this->params['breadcrumbs'][] = ['label' => 'Tratamientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tratamientos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
