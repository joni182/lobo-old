<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MedicamentosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Medicamentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medicamentos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Medicamentos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'medicamento',
            'descripcion:ntext',
            'principio',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
