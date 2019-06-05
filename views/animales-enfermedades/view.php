<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AnimalesEnfermedades */

$this->title = $model->enfermedad_id;
$this->params['breadcrumbs'][] = ['label' => 'Animales Enfermedades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="animales-enfermedades-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'enfermedad_id' => $model->enfermedad_id, 'animal_id' => $model->animal_id, 'desde' => $model->desde], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'enfermedad_id' => $model->enfermedad_id, 'animal_id' => $model->animal_id, 'desde' => $model->desde], [
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
            'animal_id',
            'desde',
            'hasta',
        ],
    ]) ?>

</div>
