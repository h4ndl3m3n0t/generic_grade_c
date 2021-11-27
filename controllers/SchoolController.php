<?php

namespace app\controllers;

use Yii;
use app\models\School;
use app\models\GradeSystem;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\helpers\DataProviderUtil;

/**
 * SchoolController implements the CRUD actions for School model.
 */
class SchoolController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all School models.
     * @param integer $sort - default to 1
     * @return mixed
     */
    public function actionIndex(int $sort = 1)
    {
        $model = School::fetchSchoolData($sort);

        GradeSystem::fetchGradeData();

        return $this->render('index', [
            'dataProvider' => DataProviderUtil::getDataProvider($model),
            'model' => $model,
            'gen_ave_sem' => School::getTotalAvg(),
        ]);
    }

    /**
     * Creates a new School model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new School();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing School model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id school id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id)
    {
        $model = (new School)->findSchool($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['semester/index', 'school_id' => $id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing School model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id school id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $id)
    {
        if(!School::deleteSchool($id)){
            Yii::$app->session->setFlash('error','Oops. Something went wrong in deleting the item :( ');
        }else{
            Yii::$app->session->setFlash('success','Successfully deleted a school/university.');
        }

        return $this->redirect(['index']);
    }

}
