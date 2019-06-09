<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VacunasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vacunas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacunas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <fieldset>
        <legend>Registrar vacuna</legend>
        <?= $this->render('create',['model' => $model]) ?>
    </fieldset>
    <fieldset>
        <legend>Lista vacunas</legend>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'vacuna',
            'dosis',
            'entre_dosis:duration',
            // 'periodicidad:duration',
            'observaciones:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</fieldset>

</div>
