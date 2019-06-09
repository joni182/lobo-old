<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UsuariosInfo */

$this->title = 'Registro nuevo usuario';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'roles' => $roles,
    ]) ?>

</div>
