<?php
use yii\helpers\Url;
use yii\helpers\Html;

?>
<div class="list-group razas-list">
    <?php foreach ($items as $model): ?>
        <a href="<?= Url::to(['/razas/view', 'id' => $model->id]) ?>" class="list-group-item"><?= $model->raza ?></a>
    <?php endforeach; ?>
</div>
