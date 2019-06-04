<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Animales */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Animales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


?>
<div class="animales-view">

    <div class="row">
        <div class="col-sm-12">
            <img class="cabecera" src="http://<?= $model->avatar != null ? $model->avatar : $imagenes[0] ?>" alt="">
        </div>
    </div>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <a class="btn btn-info" href="<?= Url::to(['animales/gestionar-imagenes', 'id' => $model->id]) ?>">Gestionar imágenes</a>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Sequro que quieres borrar?',
                'method' => 'post',
            ],
            ]) ?>
        </p>
    <div class="row ">
        <div class="col-sm-12 image-container">
            <ul class="cards">

            <?php foreach ($imagenes as $key => $imagen): ?>
                    <li class="cards__item">
                        <div class="card">
                            <div class="card__image card__image--flowers">
                                <a data-fancybox="gallery" href="http://<?= $imagen ?>">
                                    <img src="http://<?= $imagen ?>" alt="">
                                </a>
                            </div>
                            <div class="card__content">
                                <?= Html::a('Hacer Avatar', ['avatar', 'id' => $model->id, 'url' => $imagen], ['class' => 'btn btn--block card__btn btn-default']) ?>
                                <?= Html::a('Borrar', ['animales/borrar-imagen', 'id' => $model->id, 'imagen_id' => substr($imagen,strripos($imagen, '/') + 1)], [
                                    'class' => 'btn btn--block card__btn btn-danger',
                                    'data' => [
                                        'confirm' => '¿Sequro que quieres borrar?',
                                        'method' => 'post',
                                    ],
                                    ]) ?>
                                </div>
                            </div>
                        </li>
            <?php endforeach; ?>
        </ul>
        </div>
    </div>
    <div class="row">
        <div class=" col-sm-12">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'nombre',
                    'nacimiento:datetime',
                    'chip',
                    'peso:weight',
                    'ppp:boolean',
                    'esterilizado:boolean',
                    'sexo',
                    'observaciones:ntext',
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ]) ?>
        </div>
    </div>

</div>
