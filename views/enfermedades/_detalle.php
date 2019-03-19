
<div class="col-sm-4">

<div class="panel panel-primary">
    <div class="panel-heading"><?= $model->enfermedad ?></div>
    <?php if ($model->descripcion != null): ?>
        <p style="margin:10px 10px 0px 10px;display:none"><?= $model->descripcion ?></p>
    <?php endif; ?>
  <div class="panel-body">
        <?php foreach ($model->sintomas as $key => $sintoma): ?>

            <a href="<?= \yii\helpers\Url::to(['sintomas/update', 'id' => $model->id]) ?>" class="btn btn-danger btn-xs" style='margin:3px' data-toggle="tooltip" data-placement="right" title="<?= $sintoma->descripcion ?>"><?= $sintoma->sintoma ?></a>

        <?php endforeach; ?>
  </div>

</div>
</div>
