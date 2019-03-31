<?php use yii\helpers\Url; ?>
<div class="col-sm-4">

<div class="panel panel-default">
    <div class="panel-heading"><strong><?= $model->enfermedad ?></strong>
        <span class="glyphicon glyphicon-chevron-down text-right"></span>
    </div>
    <?php if ($model->descripcion != null): ?>
        <p style="margin:10px 10px 0px 10px;display:none"><?= $model->descripcion ?></p>
    <?php endif; ?>
  <div class="panel-body" id="panel-<?= $model->id ?>">
      <?php foreach ($model->sintomas as $key => $sintoma): ?>
          <a href="<?= Url::to(['sintomas/update', 'id' => $sintoma->id]) ?>" class="btn btn-warning btn-xs" style='margin:3px' data-toggle="tooltip" data-placement="right" title="<?= $sintoma->descripcion ?>">
              <?= $sintoma->sintoma ?>
          </a>
      <?php endforeach; ?>

      <a href="<?= Url::to(['enfermedades-sintomas/agregar-sintomas','enfermedad_id' => $model->id]) ?>" class="btn btn-warning btn-xs" style='margin:3px' data-toggle="tooltip" data-placement="right" title="Agrega un nuevo síntoma">
          <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
      </a>
  </div>

</div>
</div>
