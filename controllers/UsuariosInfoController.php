<?php

namespace app\controllers;

use app\models\Roles;
use app\models\Usuarios;
use app\models\UsuariosInfo;
use app\models\UsuariosInfoSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UsuariosInfoController implements the CRUD actions for UsuariosInfo model.
 */
class UsuariosInfoController extends Controller
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
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                       'allow' => true,
                       'matchCallback' => function ($rule, $action) {
                           return Yii::$app->user->identity !== null && Yii::$app->user->identity->rol_id == 1;
                       },
                    ],
                    [
                       'allow' => false,
                       'actions' => ['index', 'view', 'delete', 'create'],
                       'matchCallback' => function ($rule, $action) {
                           return Yii::$app->user->identity !== null && Yii::$app->user->identity->rol_id == 3;
                       },
                    ],
                    [
                       'allow' => true,
                       'actions' => ['update'],
                       'matchCallback' => function ($rule, $action) {
                           return Yii::$app->user->identity !== null && in_array(Yii::$app->user->identity->rol_id, [2, 3]);
                       },
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all UsuariosInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuariosInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UsuariosInfo model.
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
     * Creates a new UsuariosInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UsuariosInfo([
            'scenario' => UsuariosInfo::SCENARIO_CREATE,
            'rol_id' => 3,
        ]);

        if ($model->load(Yii::$app->request->post())) {
            $usuario = new Usuarios();
            $usuario->save();
            $model->usuario_id = $usuario->id;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
           'model' => $model,
           'roles' => Roles::todas(),
        ]);
    }

    /**
     * Updates an existing UsuariosInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = UsuariosInfo::SCENARIO_UPDATE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $model->password = $model->password_repeat = '';
        return $this->render('update', [
            'model' => $model,
            'roles' => Roles::todas(),
        ]);
    }

    /**
     * Deletes an existing UsuariosInfo model.
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
     * Finds the UsuariosInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return UsuariosInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UsuariosInfo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
