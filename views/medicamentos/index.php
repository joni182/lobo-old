<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MedicamentosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Medicamentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medicamentos-index">

    <h1><?= Html::encode($this->title) ?></h1>

<fieldset>
    <legend>Registrar un medicamento</legend>

    <div class="medicamentos-form">

        <div class="row">
            <?php $form = ActiveForm::begin([
                'action' => ['create'],
            ]); ?>
            <div class="col-sm-3">
                <?= $form->field($model, 'medicamento')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'principio')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-5">
                <?= $form->field($model, 'descripcion')->textarea(['rows' => 1]) ?>
            </div>
            <div class="col-sm-1 ">
                <div class="form-group">
                    <br>
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
                </div>
            </div>




            <?php ActiveForm::end(); ?>
        </div>
    </fieldset>

    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <fieldset>
        <legend>Lista de  medicamentos</legend>
    <table class="table table-hover">
        <tr>
            <th><?= $dataProvider->sort->link('medicamento') ?></th>
            <th><?= $dataProvider->sort->link('principio') ?></th>
            <th><?= $dataProvider->sort->link('descripcion') ?></th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($dataProvider->models as $key => $model): ?>
            <tr>
                <td><?= $model->medicamento ?></td>
                <td><?= $model->principio ?></td>
                <td><?= $model->descripcion ?></td>
                <td>
                    <?= Html::a('Borrar', ['medicamentos/delete', 'id' => $model->id], [
                        'class' => 'btn btn-xs btn-danger',
                        'data' => [
                            'confirm' => '¿Sequro que quieres borrar este medicamento?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
</fieldset>

    <?php
    // echo GridView::widget([
    //     'dataProvider' => $dataProvider,
    //     'filterModel' => $searchModel,
    //     'columns' => [
    //         ['class' => 'yii\grid\SerialColumn'],
    //         'medicamento',
    //         'descripcion:ntext',
    //         'principio',
    //
    //         ['class' => 'yii\grid\ActionColumn'],
    //     ],
    // ]);

    ?>


</div>
