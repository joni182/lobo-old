<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Personas */

$this->title = 'Adoptante';
$this->params['breadcrumbs'][] = ['label' => 'Personas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="personas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

    </p>

    <div class="row">
        <div class="col-sm-5">
            <ul class="cards">
                    <li class="cards__item" >
                        <div class="card" style="width:100%">
                            <div class="card__content">
                                <div class="card__title"><?= $model->nombre .' '. $model->primer_apellido .' '. $model->segundo_apellido ?></div>
                                <p class="card__text">
                                    <?= DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            'direccion',
                                            'telefono',
                                            'email:email',
                                            'observaciones:ntext',
                                        ],
                                    ]) ?>
                                    <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn--block card__btn btn-default']) ?>
                                    <?= Html::a('Delete', ['Borrar', 'id' => $model->id], [
                                        'class' => 'btn btn-warning',
                                        'data' => [
                                            'confirm' => '¿Estas seguro de borrar esto?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                            </div>
                        </div>
                    </li>
            </ul>
        </div>
        <div class="col-sm-5 flex-div center-h center-v">
            <a href="<?= Url::to(['acogidas/create', 'persona_id' => $model->id])  ?>" class="btn btn-lg btn-warning">Adoptar un animal</a>
        </div>
    </div>

    <div class="row">
        <div class=" col-md-12">
            <ul class="cards">
                    <li class="cards__item" >
                        <div class="card" style="width:100%">
                            <div class="card__content">
                                <div class="card__title">Adopciones</div>
                                <p class="card__text">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Animal</th>
                                            <th>Fecha</th>
                                            <th>Observaciones</th>
                                            <th>Borrar</th>
                                        </tr>
                                        <?php foreach ($model->acogidas as $acogida): ?>
                                            <tr>
                                                <td> <a href="<?= Url::to(['animales/view', 'id' => $acogida->animal->id]) ?>"> <?= $acogida->animal->nombre ?></a></td>
                                                <td><?= Yii::$app->formatter->asDate($acogida->fecha) ?></td>
                                                <td><?= $acogida->observaciones ?></td>
                                                <td><?= Html::a('Borrar', ['acogidas/delete', 'id' => $acogida->id, 'persona_id' => $model->id], [
                                                            'class' => 'btn btn-danger',
                                                            'data' => [
                                                                'confirm' => '¿Sequro que quieres borrar esta adopción?',
                                                                'method' => 'post',
                                                            ],
                                                        ])
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </p>
                            </div>
                        </div>
                    </li>
            </ul>
        </div>
    </div>


</div>
