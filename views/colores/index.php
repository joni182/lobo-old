<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ColoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Colores';
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<div class="colores-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <fieldset>
            <legend>Registrar color</legend>
            <?= $this->render('create',compact('model')) ?>
        </fieldset>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <fieldset>
        <legend>Lista</legend>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [

                'nombre',
                [
                    'attribute' => 'color',
                    'format' => 'html',
                    'value' => function ($model) {
                        return $this->render('_color', ['model' => $model]);
                    }
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update}{delete}'
                ],
            ],
        ]); ?>
    </fieldset>


</div>
