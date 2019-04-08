<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RazasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Razas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="razas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Registrar una nueva raza', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'raza',
            'especie_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
