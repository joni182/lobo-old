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
            <img class="cabecera" src="http://<?= $model->avatar != null ? $model->avatar : $imagenes[0] ?>" alt="">
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
    <h3>Información básica</h3>
    <hr>
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
                    'defuncion:date',
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ]) ?>
        </div>
    </div>

</div>
