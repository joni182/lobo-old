<?php

namespace app\controllers;

use app\models\Especies;
use app\models\Razas;
use app\models\RazasSearch;
use Exception;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * RazasController implements the CRUD actions for Razas model.
 */
class RazasController extends Controller
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
     * Lists all Razas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RazasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Razas model.
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
     * Creates a new Razas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Razas();

        if (Yii::$app->request->isAjax) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $especie_id = Yii::$app->request->post('especie_id');
            $nombre_raza = Yii::$app->request->post('raza');
            Razas::find()->where(['especie_id' => $especie_id])->andWhere(['raza' => $nombre_raza])->one();
            if (Razas::find()->where(['especie_id' => $especie_id])->andWhere(['raza' => $nombre_raza])->one() === null) {
                $model->especie_id = $especie_id;
                $model->raza = $nombre_raza;
                $model->save();
                return $this->renderAjax('/razas/_listaRazas', [
                    'items' => (Especies::findOne($especie_id))->razas,
                ]);
            }
            throw new Exception('Ya existe una raza con ese nombre.');
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'especies' => Especies::todas(),
        ]);
    }

    /**
     * Updates an existing Razas model.
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
            'especies' => Especies::todas(),
        ]);
    }

    /**
     * Deletes an existing Razas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Razas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Razas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Razas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
