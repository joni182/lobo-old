<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tratamientos */
?>
<div class="tratamientos-create">

    <h4>Requistrar un tratamiento </h4>(<a href="<?= Url::to(['medicamentos/index']) ?>">Ir a Medicamentos</a>)

    <?= $this->render('_form', [
        'model' => $model,
        'listaMedicamentos' => $listaMedicamentos,
    ]) ?>

</div>
