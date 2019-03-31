<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EnfermedadesSintomas */

$urlCreate = Url::to(['enfermedades-sintomas/create']);
$urlDelete = Url::to(['enfermedades-sintomas/delete']);
$js = <<<EOT
$( function() {
    var urlCreate = '$urlCreate';
    var urlDelete = '$urlDelete';
    $( "#sortable1, #sortable2" ).sortable({
        connectWith: ".connectedSortable",
        receive: function( event, ui ) {
            var accion = $(event.target).data('accion');
            var enfermedad = $(ui.item).data('enfermedad');
            var sintoma = $(ui.item).data('sintoma');
            var url = (accion == 'agregar' ? urlCreate : urlDelete);

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    enfermedad_id: enfermedad,
                    sintoma_id: sintoma
                }
            });
        }
    }).disableSelection();
} );
EOT;

$this->registerJs($js);

$this->title = $model->enfermedad;
// $this->params['breadcrumbs'][] = ['label' => 'Enfermedades Sintomas', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->enfermedad_id, 'url' => ['view', 'enfermedad_id' => $model->enfermedad_id, 'sintoma_id' => $model->sintoma_id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="enfermedades-sintomas-update">

    <h1><?= Html::encode($this->title) ?></h1>


</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<ul id="sortable1" data-accion="agregar" class="connectedSortable">
    <?php foreach ($model->sintomas as $sintoma): ?>
        <li data-enfermedad="<?= $model->id ?>" data-sintoma="<?= $sintoma->id ?>"  class="ui-state-default">
            <a href="<?= Url::to(['sintomas/update', 'id' => $sintoma->id]) ?>" class="btn btn-warning btn-xs" style='margin:3px' data-toggle="tooltip" data-placement="right" title="<?= $sintoma->descripcion ?>">
                <?= $sintoma->sintoma ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<ul id="sortable2" data-accion="quitar" class="connectedSortable">
    <?php foreach ($model->getSintomasQueNoTengo() as $sintoma): ?>
        <li data-enfermedad="<?= $model->id ?>" data-sintoma="<?= $sintoma->id ?>" class="ui-state-default">
            <a href="<?= Url::to(['sintomas/update', 'id' => $sintoma->id]) ?>" class="btn btn-warning btn-xs" style='margin:3px' data-toggle="tooltip" data-placement="right" title="<?= $sintoma->descripcion ?>">
                <?= $sintoma->sintoma ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
