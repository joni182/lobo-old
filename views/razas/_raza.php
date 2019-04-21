<?php

use yii\helpers\Url;

?>
<a href="<?= Url::to(['razas/update', 'id' => $model->id]) ?>" class="btn btn-warning btn-xs" style='margin:3px' data-toggle="tooltip" data-placement="right" title="">
    <?= $model->raza ?>
</a>
