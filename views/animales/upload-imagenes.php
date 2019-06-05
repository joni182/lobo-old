<?php
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Animales */

$this->title = 'Agregar imagenes de un animal';
$this->params['breadcrumbs'][] = ['label' => 'Animales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animales-create">

    <h1><?= Html::encode($this->title) ?></h1>

<?= Html::beginForm(Url::to(['animales/upload','id' => $model->id]), 'POST', ['enctype' => 'multipart/form-data']) ?>
<?= Html::fileInput('imagenes[]',null,['multiple' => 'multiple', 'accept' => 'image/*']) ?>
<?= Html::submitButton('Guardar') ?>
<?= Html::endForm() ?>

</div>
