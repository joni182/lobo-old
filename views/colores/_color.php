<?php

use yii\helpers\Url;

?>
<a href="<?= Url::to(['colores/update', 'id' => $model->id]) ?>" class="btn btn-xs" style='margin:3px;background-color:<?= $model->color ?>' data-toggle="tooltip" data-placement="right" title=" ">
    <?= $model->nombre ?>
</a>
