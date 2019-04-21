<?php

use app\components\Sortable;

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EnfermedadesSintomas */

$this->title = $model->enfermedad;
// $this->params['breadcrumbs'][] = ['label' => 'Enfermedades Sintomas', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->enfermedad_id, 'url' => ['view', 'enfermedad_id' => $model->enfermedad_id, 'sintoma_id' => $model->sintoma_id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="enfermedades-sintomas-update">

    <h1><?= Html::encode($this->title) ?></h1>


</div>

<?= Sortable::widget([
        'view' => $this,
        'item_view' => '/sintomas/_sintoma',
        'list_id' => $model->id,
        'sortable1' => [
            'accion' => Url::to(['enfermedades-sintomas/create']) ,
            'items' => $model->sintomas,
        ],
        'sortable2' => [
            'accion' => Url::to(['enfermedades-sintomas/delete']) ,
            'items' => $model->getSintomasQueNoTengo(),
        ],
    ])
?>

<div class="">
    <?= Html::a('He terminado', ['enfermedades/index'], ['class' => 'btn btn-info']) ?>
</div>
