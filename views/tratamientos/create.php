<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tratamientos */
?>
<div class="tratamientos-create">

(<a href="<?= Url::to(['medicamentos/index']) ?>">Ir a Medicamentos</a>)

    <?= $this->render('_form', [
        'model' => $model,
        'listaMedicamentos' => $listaMedicamentos,
    ]) ?>

</div>
