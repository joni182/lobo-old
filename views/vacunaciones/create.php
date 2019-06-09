<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vacunaciones */

?>
<div class="vacunaciones-create">
    (<a href="<?= Url::to(['vacunas/index']) ?>">Ir a Vacunas</a>)


    <?= $this->render('_form', [
        'url' => ['action' => ['vacunaciones/create']],
        'model' => $model,
        'vacunas' => $vacunas,
    ]) ?>

</div>
