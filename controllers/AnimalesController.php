<?php

namespace app\controllers;

use app\models\Acogidas;
use app\models\Animales;
use app\models\AnimalesColores;
use app\models\AnimalesEnfermedades;
use app\models\AnimalesRazas;
use app\models\AnimalesSearch;
use app\models\Especies;
use app\models\Medicamentos;
use app\models\Tratamientos;
use Yii;
use yii\helpers\Url;
use yii\httpclient\Client;
use yii\web\NotFoundHttpException;

/**
 * AnimalesController implements the CRUD actions for Animales model.
 */
class AnimalesController extends ControllerControlAccess
{
    /**
     * Lists all Animales models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnimalesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'especies' => Especies::todas(),
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
        $model = $this->findModel($id);
        $imagenes = $this->getImagenes($model->id);

        return $this->render('view', [
            'model' => $model,
            'imagenes' => $imagenes,
            'tratamiento' => new Tratamientos(['animal_id' => $model->id]),
            'listaMedicamentos' => Medicamentos::todas(),
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
            $client = new Client(['baseUrl' => 'http://localhost/rest/web']);
            $response = $client->get("grupos/{$model->id}")->send();
            if ($response->getData() == null) {
                $client = new Client(['baseUrl' => 'http://localhost/rest/web']);
                $response = $client->post('grupos', ['nombre' => $model->id])->send();
            }
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

        $client = new Client();
        $response = $client->createRequest()
        ->setMethod('DELETE')
        ->setUrl("http://localhost/rest/web/grupos/{$model->id}")
        ->send();

        $animal->delete();

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionUpload($id)
    {
        $model = Animales::findOne(['id' => $id]);

        if (!empty($_POST)) {
            $client = new Client();
            $request = $client->createRequest()
                ->setMethod('PUT')
                ->setUrl("http://localhost/rest/web/grupos/{$id}");

            foreach ($_FILES['imagenes']['tmp_name'] as $key => $file) {
                $request = $request->addFile("upfile[{$key}]", $file);
            }

            $response = $request->send();

            return $this->redirect(Url::to(['/animales/view', 'id' => $id]));
        }

        return $this->render('upload-imagenes', [
            'model' => $model,
        ]);
    }

    public function actionGestionarImagenes($id)
    {
        $model = $this->findModel($id);
        $imagenes = $this->getImagenes($model->id);

        return $this->render('imagenes', [
            'model' => $model,
            'imagenes' => $imagenes,
        ]);
    }

    public function actionAvatar($id, $url)
    {
        $model = $this->findModel($id);
        $model->avatar = $url;
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Se ha cambiado el avatar correctamente');
        } else {
            Yii::$app->session->setFlash('error', 'No se ha podido llevar a cabo la acción');
        }
        return $this->redirect(['animales/view', 'id' => $id]);
    }

    public function actionBorrarImagen($id, $imagen_id)
    {
        $model = $this->findModel($id);

        $client = new Client(['baseUrl' => 'http://localhost/rest/web']);
        $response = $client->delete("images/{$imagen_id}")->send();
        if ($response->getData() === 1) {
            Yii::$app->session->setFlash('success', 'Se ha borrado correctamente');
        } else {
            Yii::$app->session->setFlash('error', 'No se ha borrado la imagen');
        }

        $imagenes = $this->getImagenes($model->id);

        return $this->render('imagenes', [
            'model' => $model,
            'imagenes' => $imagenes,
        ]);
    }

    public function actionDefuncion()
    {
        $model = $this->findModel(Yii::$app->request->post('id'));
        if ($model->defuncion === null) {
            $model->defuncion = date('Y-m-d');
        } else {
            $model->defuncion = null;
        }
        if ($model->save()) {
            return 0;
        }
        throw new \Exception('Error Processing Request', 1);
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
    protected function getImagenes($id)
    {
        $client = new Client(['baseUrl' => 'http://localhost/rest/web']);
        $response = $client->get("grupos/{$id}")->send();
        return $response->getData();
    }
}
