<?php

use yii\helpers\Url;

?>
<a href="<?= Url::to(['sintomas/update', 'id' => $model->id]) ?>" class="btn btn-warning btn-xs" style='margin:3px' data-toggle="tooltip" data-placement="right" title="<?= $model->descripcion ?>">
    <?= $model->sintoma ?>
</a>
