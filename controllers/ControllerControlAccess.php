<?php

namespace app\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * TiposController implements the CRUD actions for Tipos model.
 */
class ControllerControlAccess extends Controller
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
                           return Yii::$app->user->identity !== null && in_array(Yii::$app->user->identity->rol_id, [1, 2]);
                       },
                    ],
                    [
                       'allow' => false,
                       'actions' => ['update', 'delete', 'create'],
                       'matchCallback' => function ($rule, $action) {
                           return Yii::$app->user->identity !== null && Yii::$app->user->identity->rol_id == 3;
                       },
                    ],
                    [
                       'allow' => true,
                       'actions' => ['view', 'index'],
                       'matchCallback' => function ($rule, $action) {
                           return Yii::$app->user->identity !== null && in_array(Yii::$app->user->identity->rol_id, [3]);
                       },
                    ],
                ],
            ],
        ];
    }
}
