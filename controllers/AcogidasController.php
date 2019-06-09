<?php

namespace app\controllers;

use app\models\Acogidas;
use app\models\AcogidasSearch;
use app\models\AnimalesSearch;
use app\models\Especies;
use app\models\Personas;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * AcogidasController implements the CRUD actions for Acogidas model.
 */
class AcogidasController extends ControllerControlAccess
{
    /**
     * Lists all Acogidas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AcogidasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'especies' => Especies::todas(),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Acogidas model.
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
     * Creates a new Acogidas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @param null|mixed $persona_id
     */
    public function actionCreate($persona_id = null)
    {
        $persona = Personas::findOne(['id' => $persona_id]);
        $searchModel = new AnimalesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query->leftJoin('acogidas', 'acogidas.animal_id = animales.id')->where(['acogidas.animal_id' => null]);


        if (Yii::$app->request->isPost) {
            $model = new Acogidas();
            $model->animal_id = Yii::$app->request->post('animal_id');
            $model->fecha = Yii::$app->request->post('fecha');
            $model->persona_id = Yii::$app->request->post('persona_id');
            $model->observaciones = Yii::$app->request->post('observaciones');
            $model->tipo_id = 1;
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'La adopción se ha registrado correctamente');
                return $this->redirect(['/personas/view', 'id' => $model->persona_id]);
            }
            Yii::$app->session->setFlash('error', 'No se a podido registrar la adopción.');
            return $this->redirect(['/animales/index']);
        }
        return $this->render('/animales/index', [
            'especies' => Especies::todas(),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'persona' => $persona,
        ]);
    }

    /**
     * Updates an existing Acogidas model.
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
     * Deletes an existing Acogidas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @param mixed $persona_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $persona_id)
    {
        if ($this->findModel($id)->delete()) {
            Yii::$app->session->setFlash('success', 'Se ha borrado correctamente');
        } else {
            Yii::$app->session->setFlash('error', 'No se ha podido borrar');
        }

        return $this->redirect(['personas/view', 'id' => $persona_id]);
    }

    /**
     * Finds the Acogidas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Acogidas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Acogidas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
