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
        'sortable1' => [
            'accion' => Url::to(['enfermedades-sintomas/create']) ,
            'list_id' => $model->id,
            'items' => $model->sintomas,
            'item' => [
                'name' => 'sintoma',
                'accion' => 'sintomas/update',
            ],
        ],
        'sortable2' => [
            'accion' => Url::to(['enfermedades-sintomas/delete']) ,
            'list_id' => $model->id,
            'items' => $model->getSintomasQueNoTengo(),
            'item' => [
                'name' => 'sintoma',
                'accion' => 'sintomas/update',
            ],
        ],
    ])
?>

<div class="">
    <?= Html::a('He terminado', ['enfermedades/index'], ['class' => 'btn btn-info']) ?>
</div>
