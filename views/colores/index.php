<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ColoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Colores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="colores-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Colores', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'color',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
