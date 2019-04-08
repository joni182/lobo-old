<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EspeciesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Especies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="especies-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Registrar nueva especie', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_detalle',
            ]);
        ?>
    </div>


</div>
