<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Acogidas */

$this->title = 'Create Acogidas';
$this->params['breadcrumbs'][] = ['label' => 'Acogidas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acogidas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
