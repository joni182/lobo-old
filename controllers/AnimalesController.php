<?php

namespace app\controllers;

use app\models\Acogidas;
use app\models\Animales;
use app\models\AnimalesColores;
use app\models\AnimalesEnfermedades;
use app\models\AnimalesRazas;
use app\models\AnimalesSearch;
use app\models\Especies;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\httpclient\Client;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * AnimalesController implements the CRUD actions for Animales model.
 */
class AnimalesController extends Controller
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
     * Lists all Animales models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnimalesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Animales model.
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
     * Creates a new Animales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Animales();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::to(['/animales-razas/agregar-razas', 'animal_id' => $model->id, 'especie_id' => $model->especie_id]));
        }

        return $this->render('create', [
            'model' => $model,
            'especies' => Especies::todas(),
        ]);
    }


    /**
     * Updates an existing Animales model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::to(['/animales-razas/agregar-razas', 'animal_id' => $model->id, 'especie_id' => $model->especie_id]));
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'especies' => Especies::todas(),
        ]);
    }

    /**
     * Deletes an existing Animales model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $animal = $this->findModel($id);
        Acogidas::deleteAll(['animal_id' => $animal->id]);
        AnimalesColores::deleteAll(['animal_id' => $animal->id]);
        AnimalesRazas::deleteAll(['animal_id' => $animal->id]);
        AnimalesEnfermedades::deleteAll(['animal_id' => $animal->id]);
        $animal->delete();

        return $this->redirect(['index']);
    }

    public function actionUpload($id)
    {
        $client = new Client();
        $response = $client->createRequest();
        $model = Animales::findOne(['id' => $id]);

        if (!empty($_POST)) {
            dd($_FILES);
            return $this->redirect(Url::to(['/animales-razas/agregar-razas', 'animal_id' => $model->id, 'especie_id' => $model->especie_id]));
        }

        return $this->render('upload-imagenes', [
            'model' => $model,
            'especies' => Especies::todas(),
        ]);
    }

    /**
     * Finds the Animales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Animales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Animales::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
