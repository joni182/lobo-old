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
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
        </div>
    </div>
</div>
