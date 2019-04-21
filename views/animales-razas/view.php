<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AnimalesRazas */

$this->title = $model->animal_id;
$this->params['breadcrumbs'][] = ['label' => 'Animales Razas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="animales-razas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'animal_id' => $model->animal_id, 'raza_id' => $model->raza_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'animal_id' => $model->animal_id, 'raza_id' => $model->raza_id], [
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
            'animal_id',
            'raza_id',
        ],
    ]) ?>

</div>
