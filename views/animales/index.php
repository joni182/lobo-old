<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnimalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Animales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animales-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Animales', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel, 'especies' => $especies]); ?>



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
                        Estado: No definido<br>
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
                        Grupo: <?= $model->especie->especie ?>
                    </p>
                    <a href="<?= Url::to(['animales/view', 'id' => $model->id]) ?>" class="btn btn--block card__btn btn-default">Ver</a>
                </div>
            </div>
        </li>
    <?php endforeach; ?>

</ul>


</div>
