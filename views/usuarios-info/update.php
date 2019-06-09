<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UsuariosInfo */

if (Yii::$app->user->identity->rol_id == 1) {
    $this->title =  'Actualizar: ' . "{$model->login} ( {$model->nombre} {$model->primer_apellido} {$model->segundo_apellido})";
} else {
    $this->title = 'Actualiza tu perfil';
}

$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->login, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="usuarios-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'roles' => $roles,
    ]) ?>

</div>
