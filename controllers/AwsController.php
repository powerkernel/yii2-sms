<?php
/**
 * @author Harry Tang <harry@powerkernel.com>
 * @link https://powerkernel.com
 * @copyright Copyright (c) 2017 Power Kernel
 */

namespace powerkernel\sms\controllers;

use backend\controllers\BackendController;
use powerkernel\sms\models\Setting;
use Yii;
use powerkernel\sms\models\SMS;
use powerkernel\sms\models\SMSSearch;
use yii\base\DynamicModel;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AwsController implements the CRUD actions for SMS model.
 */
class AwsController extends BackendController
{
    /**
     * @inheritdoc
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
            //'backend' => [
            //    'class' => BackendFilter::className(),
            //    'actions' => [
            //        'index',
            //    ],
            //],

            //'access' => [
            //    'class' => AccessControl::className(),
            //    'rules' => [
            //        [
            //            'roles' => ['admin'],
            //            'allow' => true,
            //        ],
            //        [
            //            'actions' => ['create', 'update'],
            //            'roles' => ['@'],
            //            'allow' => true,
            //        ],
            //    ],
            //],
        ];
    }

    /**
     * Lists all SMS models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->view->title = Yii::t('sms', 'SMS');
        $searchModel = new SMSSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * settings
     * @return string
     */
    public function actionSetting()
    {
        $attributes = Setting::loadAsArray();
        $model=new DynamicModel($attributes);
        foreach($attributes as $key=>$value){
            $model->addRule($key, 'required');
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            foreach ($attributes as $key=>$value) {
                $s = Setting::find()->where(['key' => $key])->one();
                $s->value = $model->$key;
                $s->save();
            }
            Yii::$app->session->setFlash('success', Yii::$app->getModule('sms')->t('SMS Settings saved successfully.'));
        }


        return $this->render('setting', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SMS model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionTest(){
    }

    /**
     * Finds the SMS model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SMS the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SMS::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}
