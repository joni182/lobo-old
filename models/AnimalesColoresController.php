<?php

namespace app\models;

use Yii;
use app\models\AnimalesColores;
use app\models\AnimalesColoresSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AnimalesColoresController implements the CRUD actions for AnimalesColores model.
 */
class AnimalesColoresController extends Controller
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
     * Lists all AnimalesColores models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnimalesColoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnimalesColores model.
     * @param integer $animal_id
     * @param integer $color_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($animal_id, $color_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($animal_id, $color_id),
        ]);
    }

    /**
     * Creates a new AnimalesColores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AnimalesColores();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'animal_id' => $model->animal_id, 'color_id' => $model->color_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AnimalesColores model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $animal_id
     * @param integer $color_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($animal_id, $color_id)
    {
        $model = $this->findModel($animal_id, $color_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'animal_id' => $model->animal_id, 'color_id' => $model->color_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AnimalesColores model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $animal_id
     * @param integer $color_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($animal_id, $color_id)
    {
        $this->findModel($animal_id, $color_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AnimalesColores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $animal_id
     * @param integer $color_id
     * @return AnimalesColores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($animal_id, $color_id)
    {
        if (($model = AnimalesColores::findOne(['animal_id' => $animal_id, 'color_id' => $color_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
