<?php

namespace app\controllers;

use app\models\AnimalesEnfermedades;
use app\models\AnimalesEnfermedadesSearch;
use app\models\Enfermedades;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * AnimalesEnfermedadesController implements the CRUD actions for AnimalesEnfermedades model.
 */
class AnimalesEnfermedadesController extends Controller
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
     * Lists all AnimalesEnfermedades models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnimalesEnfermedadesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnimalesEnfermedades model.
     * @param int $enfermedad_id
     * @param int $animal_id
     * @param string $desde
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($enfermedad_id, $animal_id, $desde)
    {
        return $this->render('view', [
            'model' => $this->findModel($enfermedad_id, $animal_id, $desde),
        ]);
    }

    /**
     * Creates a new AnimalesEnfermedades model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @param mixed $animal_id
     */
    public function actionCreate($animal_id = null)
    {
        $model = new AnimalesEnfermedades();

        if ($animal_id !== null) {
            $model->animal_id = $animal_id;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['animales/view', 'id' => $model->animal_id]);
        }
        return $this->render('create', [
            'model' => $model,
            'enfermedades' => Enfermedades::todas(),
        ]);
    }

    /**
     * Updates an existing AnimalesEnfermedades model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $enfermedad_id
     * @param int $animal_id
     * @param string $desde
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($enfermedad_id, $animal_id, $desde)
    {
        $model = $this->findModel($enfermedad_id, $animal_id, $desde);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['animales/view', 'id' => $model->animal_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'especies' => Enfermedades::todas(),
        ]);
    }

    /**
     * Deletes an existing AnimalesEnfermedades model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $enfermedad_id
     * @param int $animal_id
     * @param string $desde
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($enfermedad_id, $animal_id, $desde)
    {
        if ($this->findModel($enfermedad_id, $animal_id, $desde)->delete()) {
            Yii::$app->session->setFlash('success', 'Se ha realizado la acción correctamente.');
        } else {
            Yii::$app->session->setFlash('error', 'No se ha realizado la acción correctamente.');
        }
        return $this->redirect(['animales/view', 'id' => $animal_id]);
    }
    public function actionTerminar($enfermedad_id, $animal_id, $desde)
    {
        $model = $this->findModel($enfermedad_id, $animal_id, $desde);
        $model->hasta = date('Y-m-d');

        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Se ha realizado la acción correctamente.');
        } else {
            Yii::$app->session->setFlash('error', 'No se ha realizado la acción correctamente.');
        }
        return $this->redirect(['animales/view', 'id' => $animal_id]);
    }

    /**
     * Finds the AnimalesEnfermedades model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $enfermedad_id
     * @param int $animal_id
     * @param string $desde
     * @return AnimalesEnfermedades the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($enfermedad_id, $animal_id, $desde)
    {
        if (($model = AnimalesEnfermedades::findOne(['enfermedad_id' => $enfermedad_id, 'animal_id' => $animal_id, 'desde' => $desde])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
