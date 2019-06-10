<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ColoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alertas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="colores-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <fieldset>
        <legend>HOY</legend>
        <div class="tabla-alertas">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Animal</th>
                        <th>Vacuna</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vacunacionesHoy as $value): ?>
                        <tr class="danger">
                            <td> <a href="<?= Url::to(['animales/view', 'id' => $value->animal->id]) ?>"> <?= $value->animal->nombre ?> </a> </td>
                            <td><?= $value->vacuna->vacuna ?></td>
                            <td><?= Yii::$app->formatter->asDate($value->fecha) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
    </fieldset>
    <fieldset>
        <legend>Durante los proximos 7 días</legend>
        <div class="tabla-alertas">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Animal</th>
                        <th>Vacuna</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vacunacionesInminentes as $value): ?>
                        <tr class="warning">
                            <td> <a href="<?= Url::to(['animales/view', 'id' => $value->animal->id]) ?>"> <?= $value->animal->nombre ?> </a> </td>
                            <td><?= $value->vacuna->vacuna ?></td>
                            <td><?= Yii::$app->formatter->asDate($value->fecha) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
    </fieldset>

</div>
