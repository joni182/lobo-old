<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EnfermedadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Enfermedades';
$this->params['breadcrumbs'][] = $this->title;

$js = <<<EOT
    $( ".panel-heading" ).click(function() {
        console.log($(this).find('p'));
        $(this).siblings('p').toggle(200);
    });
EOT;

$this->registerJs($js);
?>

<div class="enfermedades-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Enfermedades', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<div class="row">

    <?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_detalle',
        ]);
    ?>
</div>

</div>
