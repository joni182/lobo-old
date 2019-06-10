<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Colores */

?>
<div class="colores-create">


    <?= $this->render('_form', [
        'model' => $model,
        'conf' => ['action' => ['/colores/create']],
    ]) ?>

</div>
