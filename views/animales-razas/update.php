<?php

use app\components\Sortable;

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnimalesRazas */

$this->title = 'Update Animales Razas: ' . $model->nombre;
// $this->params['breadcrumbs'][] = ['label' => 'Animales Razas', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->animal_id, 'url' => ['view', 'animal_id' => $model->animal_id, 'raza_id' => $model->raza_id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="animales-colores-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= Sortable::widget([
            'view' => $this,
            'list_id' => $model->id,
            'item_view' => '/razas/_raza',
            'sortable1' => [
                'accion' => Url::to(['animales-razas/create']) ,
                'items' => $model->razas,
            ],
            'sortable2' => [
                'accion' => Url::to(['animales-razas/delete']) ,
                'items' => $model->getRazasQueNoTengo(),
            ],
        ])
    ?>

    <div class="">
        <?= Html::a('Siguiente', ['animales-colores/agregar-colores', 'animal_id' => $model->id], ['class' => 'btn btn-info']) ?>
    </div>

</div>
