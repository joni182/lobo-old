<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Razas */

$this->title = 'Registar una nueva raza';
$this->params['breadcrumbs'][] = ['label' => 'Razas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="razas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
