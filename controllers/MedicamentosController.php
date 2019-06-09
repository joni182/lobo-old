<?php

namespace app\controllers;

use app\models\Medicamentos;
use app\models\MedicamentosSearch;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * MedicamentosController implements the CRUD actions for Medicamentos model.
 */
class MedicamentosController extends ControllerControlAccess
{
    /**
     * Lists all Medicamentos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MedicamentosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => new Medicamentos(),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Medicamentos model.
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
     * Creates a new Medicamentos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Medicamentos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Se ha creado el medicamento correctamente');
            return $this->redirect(['medicamentos/index']);
        }

        return $this->render('index', [
            'model' => empty($model->errors) ? new Medicamentos() : $model,
        ]);
    }

    /**
     * Updates an existing Medicamentos model.
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
     * Deletes an existing Medicamentos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if ($this->findModel($id)->delete()) {
            Yii::$app->session->setFlash('success', 'Se ha borrado corectamente');
        } else {
            Yii::$app->session->setFlash('error', 'No se ha podido llevar a cabo el borrado');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Medicamentos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Medicamentos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Medicamentos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
