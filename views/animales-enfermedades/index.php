<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnimalesEnfermedadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Animales Enfermedades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animales-enfermedades-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Animales Enfermedades', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'enfermedad_id',
            'animal_id',
            'desde',
            'hasta',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
