<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TratamientosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tratamientos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tratamientos-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php  echo $this->render('_search', ['model' => $searchModel, 'animales' => $animales, 'medicamentos' => $medicamentos]); ?>

    <ul class="cards">

    <?php foreach ($dataProvider->models as $key => $model): ?>
            <li class="cards__item">
                <div class="card">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card__image card__image--flowers">

                            </div>
                            <div class="card__content">
                                <a href="<?= Url::to(['animales/view', 'id' => $model->animal->id]) ?>">
                                    <img src="http://<?= $model->animal->avatar ?>" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card__content">
                                <div class="card__title">
                                    <a href="<?= Url::to(['animales/view', 'id' => $model->animal->id]) ?>">
                                        <?= $model->animal->nombre ?>
                                    </a>
                                </div>
                                <p class="card__text">
                                    Fecha: <?= Yii::$app->formatter->asDate($model->inicio) ?><br>
                                    Sexo:
                                    <?php if ($model->animal->sexo == null): ?>
                                        No definido
                                    <?php else: ?>
                                        <?php if ($model->animal->sexo == 'h'): ?>
                                            HEMBRA
                                        <?php else: ?>
                                            MACHO
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <br>
                                    Esterilizado: <?= Yii::$app->formatter->asBoolean($model->animal->esterilizado) ?>
                                    <br>
                                    Grupo: <?= $model->animal->especie->especie ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card__content">
                                <div class="card__title">
                                    <?php
                                    $cada_cuantas_horas = [
                                        1 => 'Cada 24H',
                                        2 => 'Cada 12H',
                                        3 => 'Cada 8H',
                                        4 => 'Cada 6H',
                                        6 => 'Cada 4H',
                                        8 => 'Cada 3H',
                                        12 => 'Cada 2H',
                                        24 => 'Cada 1H',
                                    ];

                                    if ($model->duracion !== null) {
                                        $fin = (new \DateTime($model->inicio))->add(new \DateInterval($model->duracion));
                                    }

                                    ?>
                                    <?= $model->medicamento->medicamento . ' ' . $cada_cuantas_horas[$model->veces_por_dia] ?>
                                </div>
                                <p class="card__text">
                                    Principio activo: <?= $model->medicamento->principio ?>
                                    <br>
                                    Dosis: <?= $model->dosis ?>
                                    <br>
                                    Inicio: <?= Yii::$app->formatter->asDate($model->inicio) ?>
                                    <br>
                                    Fin: <?= isset($fin)? Yii::$app->formatter->asDate($fin)  :'Indefinido' ?>
                                    <br>
                                    Duración: <?= $model->duracion !== null ? Yii::$app->formatter->asDuration($model->duracion) : 'Indefinido' ?>
                                    <br>
                                    <?= Html::a('Borrar', ['tratamientos/delete', 'id' => $model->id], [
                                                'class' => 'btn btn-warning',
                                                'style' => 'width:100%;margin-top:5px',
                                                'data' => [
                                                    'confirm' => '¿Sequro que quieres borrar este tratamiento?',
                                                    'method' => 'post',
                                                ],
                                            ])
                                        ?>
                                    <br>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
    <?php endforeach; ?>
</ul>



</div>
