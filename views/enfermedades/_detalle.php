<div class="col-sm-4">

<div class="panel panel-primary">
    <div class="panel-heading"><?= $model->enfermedad ?>
        <span class="glyphicon glyphicon-chevron-down text-right"></span>
    </div>
    <?php if ($model->descripcion != null): ?>
        <p style="margin:10px 10px 0px 10px;display:none"><?= $model->descripcion ?></p>
    <?php endif; ?>
  <div class="panel-body">
        <?=
        $this->render('_agregarSintoma', ['model' => $model])
        ?>
  </div>

</div>
</div>
