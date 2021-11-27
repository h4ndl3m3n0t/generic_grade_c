<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use app\models\School;

class DashboardController extends \yii\web\Controller
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
                    'delete-account' => ['post']
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSettings()
    {
        return $this->render('settings');
    }

    public function actionDeleteAccount()
    {
        if(!$this->deleteAccount()){

            Yii::$app->session->setFlash('error','Oops. Something went wrong in deleting your account :( ');
        }else{

            Yii::$app->session->setFlash('success','Successfully deleted a account.');
            return $this->redirect(['site/logout']);
        }

    }

    /**
     * Deletion of the user account.
     *
     * @return int|false
     */
    protected function deleteAccount(){
        $model = \app\models\User::findByUsername(\Yii::$app->user->identity->username);
        if($model->username == 'seeker' || $model->username == 'handler'){
            throw new BadRequestHttpException("You can't remove this pre-default account for the demo.",500);
        }else{
            foreach (School::find()
                    ->author(Yii::$app->user->id)
                    ->all() as $school) {;

                if(!School::deleteSchool($school['id'])){
                    Yii::$app->session->setFlash('error','Oops. Something went wrong in deleting the item :( ');
                }else{
                    Yii::$app->session->setFlash('success','Successfully deleted a school/university.');
                }
            }

            return $model->delete();
        }
        return false;
    }

}
