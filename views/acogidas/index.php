<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AcogidasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Acogidas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acogidas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Acogidas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= $this->render('_search', ['model' => $searchModel, 'especies' => $especies ]); ?>

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
                                    Fecha: <?= Yii::$app->formatter->asDate($model->fecha) ?><br>
                                    Estado: <?= $model->tipo->tipo ?><br>
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
                                    <a href="<?= Url::to(['personas/view', 'id' => $model->persona->id]) ?>">
                                        <?= $model->persona->nombre . ' ' . $model->persona->primer_apellido . ' ' . $model->persona->segundo_apellido?>
                                    </a>
                                </div>
                                <p class="card__text">
                                    Direccion: <?= $model->persona->direccion ?>
                                    <br>
                                    Telefono: <?= $model->persona->telefono ?>
                                    <br>
                                    Email: <?= $model->persona->email ?>
                                    <br>
                                    <?= Html::a('Borrar', ['acogidas/delete', 'id' => $model->id, 'persona_id' => $model->persona->id], [
                                                'class' => 'btn btn-warning',
                                                'style' => 'width:100%;margin-top:5px',
                                                'data' => [
                                                    'confirm' => '¿Sequro que quieres borrar esta adopción?',
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
