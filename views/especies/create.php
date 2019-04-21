<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Especies */

$this->title = 'Registrar una nueva especie';
$this->params['breadcrumbs'][] = ['label' => 'Especies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="especies-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
