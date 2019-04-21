<?php
use yii\helpers\Html;
?>
<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading<?= $model->id?>">
        <h4 class="panel-title">
            <div class="row">
                <div class="col-sm-6">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $model->id?>" aria-expanded="true" aria-controls="collapse">
                            <?= $model->especie ?>
                    </a>
                </div>
                <div class="col-sm-6" style="text-align: right">
                    <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-xs btn-primary']) ?>
                    <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-xs btn-danger',
                        'data' => [
                            'confirm' => "¡IMPORTANTE! \n\nSi lo borras se borraran todas las razas que contenga.\n\n¿Estas seguro de que quieres borrar este elemento?\n\n",
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
            </div>
        </h4>
    </div>
    <div id="collapse<?= $model->id?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?= $model->id?>">
        <div class="panel-body">
            <?= Html::beginForm(['razas/create'], 'post') ?>
            <div class="row">
                  <div class="col-lg-6">
                    <div class="input-group">
                      <?= Html::input('text', 'raza', null, [
                          'id' => "input-{$model->id}",
                          'class' => 'form-control',
                          'data' => [
                              'enfermedad' => $model->id ,
                          ],
                          'placeholder'=>"Registra una nueva raza en esta especie ({$model->especie})",
                          'required' => 'true',
                          ]) ?>
                          <span class="input-group-btn">
                              <button value="<?= $model->id ?>" class="btn btn-default registrar-raza" type="submit">¡Registrar!</button>
                          </span>
                    </div>
                </div>
            </div>
            <?= Html::endForm() ?>
            <div class="error-<?= $model->id ?>">
            </div>
            <div class="razas-<?= $model->id ?>">
                <?= $this->render('/razas/_listaRazas', [
                    'items' => $model->razas,
                    ]) ?>
            </div>
        </div>
    </div>
</div>
