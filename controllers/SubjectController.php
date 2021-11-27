<?php

namespace app\controllers;

use Yii;
use app\models\Subject;
use app\models\Semester;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\helpers\DataProviderUtil;
use app\models\GradeSystem;

/**
 * SubjectController implements the CRUD actions for Subject model.
 */
class SubjectController extends Controller
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
                    'print' => ['post']
                ],
            ],
        ];
    }

    /**
     * Lists all Semester models.
     * @param integer $school_id school id
     * @param integer $sem_id semester id
     * @param integer $sort sort by name, date and grade (default to 2 = latest)
     * @return mixed
     */
    public function actionIndex(int $school_id, int $sem_id, int $sort = 2){

        $model = Subject::fetchSubjectData($school_id,$sem_id,$sort);

        GradeSystem::fetchGradeData();

        return $this->render('index', [
            'dataProvider' => DataProviderUtil::getDataProvider($model),
            'model' => $model,
            'sem_model' => Semester::findSemester($sem_id,$school_id),
            'gen_ave' => Subject::getAvgPerSubject($school_id,$sem_id) //prefer to cache this shit if necessary
        ]);
    }

    /**
     * Displays a single Subject model.
     * @param integer $id for subject id
     * @param integer $school_id for school id
     * @param integer $sem_id for sem id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $school_id, int $sem_id, int $id)
    {
        return $this->render('view', [
            'model' => Subject::findSubject($id,$sem_id,$school_id),
        ]);
    }

    /**
     * Creates a new Subject model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $school_id - school id
     * @param integer $sem_id - semester id
     * @return mixed
     */
    public function actionCreate(int $school_id, int $sem_id)
    {
        $model = new Subject();
        $model->school_id = $school_id;
        $model->sem_id = $sem_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([
                'index',
                'school_id' => $school_id,
                'sem_id' => $sem_id
            ]);
        }

        return $this->render('create', [
            'model' => $model,
            'sem_model' => $model['semester']
        ]);
    }

    /**
     * Updates an existing Subject model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the subject id to be updated
     * @param integer $school_id - school id
     * @param integer $sem_id - semester id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $school_id, int $sem_id, int $id)
    {
        $model = Subject::findSubject($id, $sem_id, $school_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

        Yii::$app->session->setFlash('success','Successfully updated a subject.');

            return $this->redirect([
                'index',
                'school_id' => $school_id,
                'sem_id' => $sem_id
            ]);
        }

        return $this->render('update', [
            'model' => $model,
            'sem_model' => $model['semester']
        ]);
    }

    /**
     * Deletes an existing Subject model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $school_id, int $sem_id, int $id)
    {
        $is_delete = Subject::findSubject($id, $sem_id, $school_id)->delete();
        if(!$is_delete){
            Yii::$app->session->setFlash('error','Oops. Something went wrong in deleting the item :( ');
        }else{
            Yii::$app->session->setFlash('success','Successfully deleted a subject.');
        }

        return $this->redirect([
            'index',
            'school_id' => $school_id,
            'sem_id' => $sem_id
        ]);
    }


    /**
     * Print a Subject.
     * @param integer $id for subject id
     * @param integer $school_id for school id
     * @param integer $sem_id for sem id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPrint(int $school_id, int $sem_id, int $id = 0)
    {
        if($id != 0){
            return Subject::printSubject($school_id,$sem_id,$id);
        }

        return Subject::printSubjects($school_id,$sem_id);
    }
}
