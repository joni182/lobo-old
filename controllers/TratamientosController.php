<?php

namespace app\controllers;

use app\models\Animales;
use app\models\Medicamentos;
use app\models\Tratamientos;
use app\models\TratamientosSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * TratamientosController implements the CRUD actions for Tratamientos model.
 */
class TratamientosController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tratamientos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TratamientosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query->select('tratamientos.*, (inicio + duracion) AS fin')->joinWith('animal')->where('(inicio > now() AND (inicio + duracion) > now()) OR inicio < now() AND duracion IS NULL')->groupBy('animales.id, tratamientos.id');

        return $this->render('index', [
            'animales' => Animales::find()->select('nombre')->where('id in (SELECT animal_id from tratamientos)')->indexBy('id')->column(),
            'medicamentos' => Medicamentos::todas(),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tratamientos model.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tratamientos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        extract(Yii::$app->request->post());
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = new Tratamientos();

        $model->animal_id = $animal_id;
        $model->medicamento_id = $medicamento_id;
        $model->veces_por_dia = $veces_por_dia;
        $model->dosis = $dosis;
        $model->inicio = $inicio;
        $model->observaciones = $observaciones;
        $model->duracion = $duracion;

        if ($model->duracion) {
            $model->duracion = "{$model->duracion} days";
        }
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Se ha registrado el nuevo tratamiento.');
        } else {
            Yii::$app->session->setFlash('error', 'No se ha podido registrar el nuevo tratamiento.');
        }

        return $this->redirect(['/animales/view', 'id' => $model->animal_id]);
    }


    /**
     * Updates an existing Tratamientos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tratamientos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $animal_id = $model->animal_id;

        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'No se ha llevado a cabo la acción requerida');
        } else {
            Yii::$app->session->setFlash('error', 'No se ha podido llevar a cabo la acción');
        }

        return $this->redirect(['/animales/view', 'id' => $model->animal_id]);
    }

    /**
     * Finds the Tratamientos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Tratamientos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tratamientos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
