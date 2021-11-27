<?php

namespace app\controllers;

use Yii;
use app\models\Semester;
use app\models\School;
use app\models\GradeSystem;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\helpers\DataProviderUtil;

/**
 * SemesterController implements the CRUD actions for Semester model.
 */
class SemesterController extends Controller
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
                    'print' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Semester models.
     * @param integer $school_id - school id
     * @param integer $sort - default to 2
     * @return mixed
     */
    public function actionIndex(int $school_id, int $sort = 2){

        $model = Semester::fetchSemesterData($school_id,$sort);
        GradeSystem::fetchGradeData();

        return $this->render('index', [
            'dataProvider' => DataProviderUtil::getDataProvider($model),
            'model' => $model,
            'school_model' => School::findSchool($school_id),
            'gen_ave_sem' => Semester::getTotalAvg($school_id)
        ]);
    }

    /**
     * Creates a new Semester model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @param integer $school_id   where will get the school id
     * @return mixed
     */
    public function actionCreate(int $school_id)
    {
        $model = new Semester();
        $model->school_id = $school_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'school_id' => $school_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'school_id' => $school_id
        ]);
    }

    /**
     * Updates an existing Semester model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $school_id the school id
     * @param integer $id the semester id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $school_id, int $id)
    {

        $model = Semester::findSemester($id, $school_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([
                'subject/index',
                'school_id' => $model->school_id,
                'sem_id' => $model->id
            ]);
        }

        return $this->render('update', [
            'model' => $model,
            'school_id' => $school_id
        ]);
    }

    /**
     * Deletes an existing Semester model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id semester id
     * @param integer $school_id school id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $id, int $school_id)
    {

        if(!Semester::deleteSemester($id,$school_id)){
            Yii::$app->session->setFlash('error','Oops. Something went wrong in deleting the item :( ');
        }else{
            Yii::$app->session->setFlash('success','Successfully deleted a semester.');
        }

        return $this->redirect([
            'index',
            'school_id' => $school_id
        ]);
    }


    /**
     * Print all semester and the subjects inside it.
     * @param integer $school_id for school id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPrint(int $school_id)
    {
        return Semester::printSemesters($school_id);
    }


}
