<?php

use yii\helpers\Url;

?>
<div class="color-panel">

<a href="<?= Url::to(['colores/update', 'id' => $model->id]) ?>">
    <div class="color" style='background-color:<?= $model->color ?>'>

    </div>
    <?= $model->nombre ?>
</a>
</div>
