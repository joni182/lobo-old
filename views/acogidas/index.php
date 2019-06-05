<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AcogidasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Acogidas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acogidas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Acogidas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'precio',
            'fecha',
            'duracion',
            'observaciones:ntext',
            //'tipo_id',
            //'animal_id',
            //'persona_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
