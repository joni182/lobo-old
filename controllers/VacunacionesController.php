<?php

namespace app\controllers;

use Yii;
use app\models\Vacunaciones;
use app\models\VacunacionesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VacunacionesController implements the CRUD actions for Vacunaciones model.
 */
class VacunacionesController extends Controller
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
     * Lists all Vacunaciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VacunacionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vacunaciones model.
     * @param integer $vacuna_id
     * @param integer $animal_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($vacuna_id, $animal_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($vacuna_id, $animal_id),
        ]);
    }

    /**
     * Creates a new Vacunaciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vacunaciones();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'vacuna_id' => $model->vacuna_id, 'animal_id' => $model->animal_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Vacunaciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $vacuna_id
     * @param integer $animal_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($vacuna_id, $animal_id)
    {
        $model = $this->findModel($vacuna_id, $animal_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'vacuna_id' => $model->vacuna_id, 'animal_id' => $model->animal_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Vacunaciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $vacuna_id
     * @param integer $animal_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($vacuna_id, $animal_id)
    {
        $this->findModel($vacuna_id, $animal_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Vacunaciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $vacuna_id
     * @param integer $animal_id
     * @return Vacunaciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($vacuna_id, $animal_id)
    {
        if (($model = Vacunaciones::findOne(['vacuna_id' => $vacuna_id, 'animal_id' => $animal_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
