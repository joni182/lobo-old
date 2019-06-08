<?php

use kartik\date\DatePicker;

use kartik\number\NumberControl;

use kartik\widgets\Select2;

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Animales */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Animales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$js = <<<JS
$('button#difunto').click((e)=>{
    boton = $(e.target);
    var url = boton.data('url');
    var id = boton.data('id');

    if (boton.hasClass('btn-warning')) {
        boton.removeClass('btn-warning');
        boton.addClass('btn-default');
    } else {
        boton.removeClass('btn-default');
        boton.addClass('btn-warning');
    }

    $.ajax({
        url:url,
        type:'POST',
        data:{
            id:id
        },
        success:(data)=>{
            if (data == 0) {
                if (boton.hasClass('btn-warning')) {
                    boton.text('Marcar como difunto');
                } else {
                    boton.text('Marcar como no difunto');
                }
            }
        },
        error:(data)=>{
            if (boton.hasClass('btn-warning')) {
                boton.removeClass('btn-warning');
                boton.addClass('btn-default');
            } else {
                boton.removeClass('btn-default');
                boton.addClass('btn-warning');
            }
        }
    })
});
JS;

$this->registerJs($js);
?>
<div class="animales-view">

    <div class="row">
        <div class="col-sm-12">
            <?php if (empty($imagenes)) {
                $avatar = 'picsum.photos/800/600?image=82';
            } else {
                $avatar = $imagenes[0];
            } ?>
            <img class="cabecera" src="http://<?= $model->avatar != null ? $model->avatar : $avatar ?>" alt="">
        </div>
    </div>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Sequro que quieres borrar?',
                'method' => 'post',
            ],
            ]) ?>
        <button type="button" data-id="<?= $model->id ?>" data-url="<?= Url::to(['animales/defuncion']) ?>" class="btn <?= $model->defuncion === null ? 'btn-warning' : 'btn-default' ?>" id="difunto"><?= $model->defuncion === null ? 'Marcar como difunto' : 'Marcar como no difunto' ?></button>
        </p>
        <br>
        <h3>Imágenes</h3>
        <hr>

        <a class="btn btn-info" href="<?= Url::to(['animales/upload', 'id' => $model->id]) ?>">Agregar imágenes</a>
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
    <br>
    <h3>Información Veterinária</h3>
    <hr>
    <!-- Tratamientos   -->
    <fieldset>
        <legend>Tratamientos</legend>

        <div class="tabla-tratamientos">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Medicamento</th>
                        <th>Inicio</th>
                        <!-- <th>Duración</th> -->
                        <th>Fin</th>
                        <th>Pauta</th>
                        <th>Dosis</th>
                        <th>Observaciones</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
                <tbody>
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
                    foreach ($model->getTratamientos()->orderBy('inicio', 'DESC')->all() as $value):

                        $activo = false;
                        $ahora = new \DateTime('now');
                        $inicio = new \DateTime($value->inicio);
                        $fin = null;

                        if ($value->duracion === null ) {
                            if ($inicio < $ahora) {
                                $activo = true;
                            }
                        } else {
                            $fin = (new \DateTime($value->inicio))->add(new \DateInterval($value->duracion));
                            if ($inicio < $ahora && $ahora  < $fin ) {
                                $activo = true;
                            }
                        }

                        ?>
                        <tr class="<?= $activo ? 'danger' : '' ?>">
                            <td><?= $value->medicamento->medicamento.'('.$value->medicamento->principio.')' ?></td>
                            <td><?= Yii::$app->formatter->asDate($value->inicio) ?></td>
                            <!-- <td><?php // echo Yii::$app->formatter->asDuration($value->duracion) ?></td> -->
                            <td><?= Yii::$app->formatter->asDate(isset($fin) ? $fin->format('y-m-d') : null) ?></td>
                            <td><?= $cada_cuantas_horas[$value->veces_por_dia] ?></td>
                            <td><?= $value->dosis ?></td>
                            <td><?= $value->observaciones ?></td>
                            <td>
                                <?= Html::a('Borrar', ['tratamientos/delete', 'id' => $value->id], [
                                'class' => 'btn btn-xs btn-danger',
                                'data' => [
                                'confirm' => '¿Sequro que quieres borrar?',
                                'method' => 'post',
                                ],
                                ]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?= $this->render('/tratamientos/create', ['model' => $tratamiento, 'listaMedicamentos' => $listaMedicamentos]) ?>

    </fieldset>
    <!-- Fin Tratamientos   -->


    <!-- Enfermedades -->
    <fieldset>
        <legend>Enfermedades</legend>


    <?= Html::a('Asignar enfermedad', ['animales-enfermedades/create', 'animal_id' => $model->id], ['class' => 'btn btn-primary']) ?>

    <h4>Historial</h4>

    <table class="table table-hover">
        <tr>
            <th>Enfermedad</th>
            <th>Desde</th>
            <th>Hasta</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($model->animalesEnfermedades as $key => $registro): ?>
            <tr class="<?= $registro->hasta == null ? 'warning' : 'info'?>">
                <td><?= $registro->enfermedad->enfermedad ?></td>
                <td><?= Yii::$app->formatter->asDate($registro->desde) ?></td>
                <td><?= $registro->hasta == null ? 'actualidad' : Yii::$app->formatter->asDate($registro->hasta) ?></td>
                <td><?php if ($registro->hasta == null): ?>
                    <?= Html::a('Terminar enfermedad', ['animales-enfermedades/terminar', 'enfermedad_id'=> $registro->enfermedad_id, 'animal_id'=> $registro->animal_id, 'desde'=> $registro->desde], [
                        'class' => 'btn btn-info btn-xs',
                        'data' => [
                            'confirm' => '¿Sequro que quieres terminar la enfermedad?',
                            'method' => 'post',
                        ],
                        ]) ?>
                <?php endif; ?>
                    <?= Html::a('Borrar registro', ['animales-enfermedades/delete', 'enfermedad_id'=> $registro->enfermedad_id, 'animal_id'=> $registro->animal_id, 'desde'=> $registro->desde], [
                        'class' => 'btn btn-danger btn-xs',
                        'data' => [
                            'confirm' => '¿Sequro que quieres borrar?',
                            'method' => 'post',
                        ],
                        ]) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</fieldset>
<!-- Fin Enfermedades -->
<h3>Información básica</h3>
<hr>
<div class="row">
    <div class=" col-sm-12">

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'nombre',
                'especie.especie:text:Grupo',
                [
                    'attribute' => 'razas',
                    'label' => 'Razas',
                    'value' => function ($model,$widget){
                        $razas = '';
                        foreach ($model->razas as $raza) {
                            $razas .= $raza->raza . ' ';
                        }
                        return $razas;
                    },

                ],
                [
                    'attribute' => 'colores',
                    'label' => 'Colores',
                    'value' => function ($model,$widget){
                        $colores = '';
                        foreach ($model->colors as $color) {
                            $colores .= $color->nombre . ' ';
                        }
                        return $colores;
                    },

                ],
                'nacimiento:datetime',
                'chip',
                'peso:weight',
                'ppp:boolean',
                'esterilizado:boolean',
                'sexo',
                'observaciones:ntext',
                'defuncion:date',
                'created_at:datetime',
                'updated_at:datetime',
            ],
        ]) ?>
    </div>
</div>


<br>
</div>
