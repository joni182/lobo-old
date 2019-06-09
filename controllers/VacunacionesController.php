<?php

namespace app\controllers;

use app\models\Vacunaciones;
use app\models\VacunacionesSearch;
use app\models\Vacunas;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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
     * @param int $vacuna_id
     * @param int $animal_id
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

        if ($model->load(Yii::$app->request->post())) {
            $vacuna = Vacunas::findOne(['id' => $model->vacuna_id]);

            if ($vacuna->dosis = null) {
                $model->save();
            } else {
                for ($i = 0; $i < $vacuna->dosis; $i++) {
                    if ($i != 0) {
                        $model->id = null;
                        $fecha = new \DateTime($model->fecha);
                        $fecha->add(new \DateInterval($vacuna->entre_dosis));
                        $model->fecha = $fecha->format('Y-m-d');
                        $model->save();
                    }
                    $model->save();
                }
            }
        }

        return $this->redirect(['animales/view', 'id' => $model->animal_id]);
    }

    /**
     * Updates an existing Vacunaciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $vacuna_id
     * @param int $animal_id
     * @param mixed $fecha
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($vacuna_id, $animal_id, $fecha)
    {
        $model = $this->findModel($vacuna_id, $animal_id, $fecha);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'vacuna_id' => $model->vacuna_id, 'animal_id' => $model->animal_id, 'fecha' => $model->fecha]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Vacunaciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $vacuna_id
     * @param int $animal_id
     * @param mixed $fecha
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($vacuna_id, $animal_id, $fecha)
    {
        $this->findModel($vacuna_id, $animal_id, $fecha)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Vacunaciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $vacuna_id
     * @param int $animal_id
     * @param mixed $fecha
     * @return Vacunaciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($vacuna_id, $animal_id, $fecha)
    {
        if (($model = Vacunaciones::findOne(['vacuna_id' => $vacuna_id, 'animal_id' => $animal_id, 'fecha' => $fecha])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
