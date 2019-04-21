<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnimalesColoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Animales Colores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animales-colores-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Animales Colores', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'animal_id',
            'color_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
