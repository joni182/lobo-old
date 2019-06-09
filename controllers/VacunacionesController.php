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
     * @param mixed $id
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
     * Creates a new Vacunaciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vacunaciones();
        if ($model->load(Yii::$app->request->post())) {
            $vacuna = Vacunas::findOne(['id' => $model->vacuna_id]);
            $fecha = $model->fecha;
            if ($vacuna->dosis == 1) {
                $model->save();
            } else {
                for ($i = 0; $i < $vacuna->dosis; $i++) {
                    $fechaNueva = new \DateTime($fecha);
                    if ($i != 0) {
                        $fechaNueva->add(new \DateInterval($vacuna->entre_dosis));
                    }
                    $model = new Vacunaciones();
                    $model->load(Yii::$app->request->post());
                    $fecha = $model->fecha = $fechaNueva->format('Y-m-d');
                    $model->save();
                }
            }
        }
        return $this->redirect(['animales/view', 'id' => $model->animal_id]);
    }

    /**
     * Updates an existing Vacunaciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param mixed $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['animales/view', 'id' => $model->animal_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'vacunas' => Vacunas::todas(),
        ]);
    }

    /**
     * Deletes an existing Vacunaciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $animal_id = $model->animal_id;
        $model->delete();

        return $this->redirect(['/animales/view', 'id' => $animal_id]);
    }

    /**
     * Finds the Vacunaciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param mixed $id
     * @return Vacunaciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vacunaciones::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
