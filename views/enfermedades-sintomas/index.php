<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EnfermedadesSintomasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Enfermedades Sintomas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enfermedades-sintomas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Enfermedades Sintomas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'enfermedad.enfermedad',
            'sintoma.sintoma',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
