<?php

use app\models\Roles;

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;

$url = Url::to(['usuarios-info/cambiar-rol']);
$js = <<<JS
    $('#usuariosinfo-rol_id').click((e) => {
        var id = $(e.target).parents('tr').data('key');
        var rol_id = $(e.target).val();

        $.ajax({
            type:'POST',
            url:'$url',
            data:{
                id:id,
                rol_id:rol_id
            },
            success: () => {
                $.notify('Se ha llevado a cabo la acción','success')
            },
            error: () => {
                $.notify('No se ha podido llevar a cabo la acción','error')
            }
        });
    });
JS;

$this->registerJs($js);
?>
<div class="usuarios-info-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Registrar Usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nombre',
            'primer_apellido',
            'segundo_apellido',
            //'login',
            //'password',
            'email:email',
            //'access_token',
            //'validate_token',
            [
                'attribute' => 'validated_at',
                'format' => 'boolean',
                'value' => function ($data) {
                    return (bool)$data->validated_at;
                },
            ],
            [
                'attribute' => 'rol_id',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::activeDropDownList($data, 'rol_id', Roles::todas(), ['class' => 'rol_id form-control']);
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>


</div>
