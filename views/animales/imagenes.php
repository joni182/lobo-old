<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnimalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gestionar Imágenes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animales-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <a class="btn btn-default" href="<?= Url::to(['animales/upload', 'id' => $model->id]) ?>">Agregar imágenes</a>
    <a class="btn btn-default" href="<?= Url::to(['animales/view', 'id' => $model->id]) ?>">volver</a>
    <ul class="cards">
        <?php foreach ($imagenes as $imagen): ?>
            <li class="cards__item">
                <div class="card">
                    <div class="card__image card__image--flowers"><img src="http://<?= $imagen ?>" alt=""></div>
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
