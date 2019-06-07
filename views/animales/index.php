<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnimalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Animales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animales-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Registrar un animal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
        $parametros =  [
            'model' => $searchModel,
            'especies' => $especies,
        ];
        if (isset($persona)) {
            $parametros['url'] = ['acogidas/create', 'persona_id' => $persona->id];
        }
    ?>
    <?php echo $this->render('_search', $parametros); ?>



<ul class="cards">
    <?php foreach ($dataProvider->getModels() as $model): ?>
        <li class="cards__item">
            <div class="card">
                <div class="card__image card__image--flowers">
                    <a href="<?= Url::to(['animales/view', 'id' => $model->id]) ?>">
                        <img src="http://<?= $model->avatar ?>" alt="">
                    </a>
                </div>
                <div class="card__content">
                    <div class="card__title"><?= $model->nombre ?></div>
                    <p class="card__text">
                        <?php $tipo = ($acogida = $model->getAcogidas()->one()) == null ? 'ACOGIDO' : $acogida->tipo->tipo ?>
                        Estado: <?= $tipo ?><br>
                        Sexo:
                        <?php if ($model->sexo == null): ?>
                            No definido
                        <?php else: ?>
                            <?php if ($model->sexo == 'h'): ?>
                                HEMBRA
                            <?php else: ?>
                                MACHO
                            <?php endif; ?>
                        <?php endif; ?>
                        <br>
                        Esterilizado: <?= Yii::$app->formatter->asBoolean($model->esterilizado) ?>
                        <br>
                        Peso: <?= Yii::$app->formatter->asWeight($model->peso) ?>
                        <br>
                        Grupo: <?= $model->especie->especie ?>
                    </p>
                    <?php if (isset($persona)): ?>
                        <form class="" action="<?= Url::to(['acogidas/create']) ?>" method="post">
                                <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                            <input type="hidden" name="persona_id" value="<?= $persona->id ?>">
                            <input type="hidden" name="animal_id" value="<?= $model->id ?>">
                            <input type="hidden" name="fecha" value="<?= \date('Y-m-d') ?>">
                            <textarea name="observaciones" rows="2" cols="20" placeholder="Observaciones sobre la adopción"></textarea>
                            <button class="btn-warning" type="submit">Adoptar por <?= $persona->nombre . ' ' . $persona->primer_apellido ?></button>
                        </form>
                    <?php else: ?>
                        <a href="<?= Url::to(['animales/view', 'id' => $model->id]) ?>" class="btn btn--block card__btn btn-default">Ver</a>
                    <?php endif; ?>
                </div>
            </div>
        </li>
    <?php endforeach; ?>

</ul>


</div>
