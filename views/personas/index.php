<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Adoptantes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Registrar adoptante', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <ul class="cards">
        <?php foreach ($dataProvider->getModels() as $model): ?>
            <li class="cards__item">
                <div class="card">
                    <div class="card__content">
                        <div class="card__title"><?= $model->nombre .' '. $model->primer_apellido .' '. $model->segundo_apellido ?></div>
                        <p class="card__text">
                            Direccion: <?= $model->direccion ?>
                            <br>
                            Telefono: <?= $model->telefono ?>
                            <br>
                            Email: <?= $model->email ?>
                            <br>
                            Observaciones: <?= $model->observaciones ?>
                            <br>
                        </p>
                        <a href="<?= Url::to(['personas/view', 'id' => $model->id]) ?>" class="btn btn--block card__btn btn-default">Ver</a>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>

    </ul>



</div>
