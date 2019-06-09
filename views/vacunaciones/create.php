<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vacunaciones */

$this->title = 'Create Vacunaciones';
$this->params['breadcrumbs'][] = ['label' => 'Vacunaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacunaciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
