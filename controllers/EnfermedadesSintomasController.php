<?php

namespace app\controllers;

use Yii;
use app\models\EnfermedadesSintomas;
use app\models\EnfermedadesSintomasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EnfermedadesSintomasController implements the CRUD actions for EnfermedadesSintomas model.
 */
class EnfermedadesSintomasController extends Controller
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
     * Lists all EnfermedadesSintomas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EnfermedadesSintomasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EnfermedadesSintomas model.
     * @param integer $enfermedad_id
     * @param integer $sintoma_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($enfermedad_id, $sintoma_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($enfermedad_id, $sintoma_id),
        ]);
    }

    /**
     * Creates a new EnfermedadesSintomas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EnfermedadesSintomas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'enfermedad_id' => $model->enfermedad_id, 'sintoma_id' => $model->sintoma_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EnfermedadesSintomas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $enfermedad_id
     * @param integer $sintoma_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($enfermedad_id, $sintoma_id)
    {
        $model = $this->findModel($enfermedad_id, $sintoma_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'enfermedad_id' => $model->enfermedad_id, 'sintoma_id' => $model->sintoma_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EnfermedadesSintomas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $enfermedad_id
     * @param integer $sintoma_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($enfermedad_id, $sintoma_id)
    {
        $this->findModel($enfermedad_id, $sintoma_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EnfermedadesSintomas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $enfermedad_id
     * @param integer $sintoma_id
     * @return EnfermedadesSintomas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($enfermedad_id, $sintoma_id)
    {
        if (($model = EnfermedadesSintomas::findOne(['enfermedad_id' => $enfermedad_id, 'sintoma_id' => $sintoma_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
