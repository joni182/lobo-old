<?php

use yii\helpers\Url;
use yii\helpers\Html;

use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EspeciesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$url = Url::to(['razas/create']);
$js =<<<EOT
$('.registrar-raza').click((e)=>{
    e.preventDefault();
    var especieId = $(e.target).val();
    var input = $('#input-'+especieId);
    if (input.val() !== '') {
    $.ajax({
            dataType: 'json',
            type: 'post',
            url: "$url",
            data: { raza:input.val(), especie_id: especieId },
            success: (respuesta) => {
                $('.razas-'+especieId).html(respuesta);
            },
            error: (respuesta) => {
                console.log(respuesta)
                var mensaje = `<div class="alert alert-warning alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>¡Error!</strong> `+respuesta.responseJSON.message+`
                </div>`
                $('.error-'+especieId).html(mensaje);
            }
        });
    }
    input.val('');
});
EOT;
$this->registerJs($js);

$this->title = 'Especies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="especies-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Registrar nueva especie', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_detalle',
            ]);
        ?>
    </div>


</div>
