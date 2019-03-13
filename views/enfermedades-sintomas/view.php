<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EnfermedadesSintomas */

$this->title = $model->enfermedad_id;
$this->params['breadcrumbs'][] = ['label' => 'Enfermedades Sintomas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="enfermedades-sintomas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'enfermedad_id' => $model->enfermedad_id, 'sintoma_id' => $model->sintoma_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'enfermedad_id' => $model->enfermedad_id, 'sintoma_id' => $model->sintoma_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'enfermedad_id',
            'sintoma_id',
        ],
    ]) ?>

</div>
