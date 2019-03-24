<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Sintomas;
?>

<?php foreach ($model->sintomas as $key => $sintoma): ?>
    <a href="<?= \yii\helpers\Url::to(['sintomas/update', 'id' => $model->id]) ?>" class="btn btn-danger btn-xs" style='margin:3px' data-toggle="tooltip" data-placement="right" title="<?= $sintoma->descripcion ?>">
        <?= $sintoma->sintoma ?>
    </a>
<?php endforeach; ?>

<button type="button" class="btn btn-danger btn-xs desplegarFrom" style='margin:3px' data-toggle="tooltip" data-placement="right" title="Agrega un nuevo síntoma">
    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
</button>

<?= Html::beginForm(
    Url::to(['enfermedades-sintomas/create']),
    null,
    [
        'class' => 'sintoma',
        'style' => 'display:none'
        ]
    )
?>
    <?= Html::dropDownList('sintoma', null, Sintomas::todos(),[
        'class' => 'form-control',
        ]) ?>
    <?= Html::hiddenInput('enfermedad', $model->id ) ?>
    <?= Html::button('Añadir',
        [
            'data' => [
                'enfermedad' => $model->id,
            ],
            'class' => 'btn btn-info submit',
        ]
    ) ?>
<?= Html::endForm()?>
